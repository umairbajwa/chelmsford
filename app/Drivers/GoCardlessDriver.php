<?php

namespace App\Drivers;

use App\CoveragePayment;
use Exception;
use GoCardlessPro\Client;
use GoCardlessPro\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GoCardlessDriver
{
    private $client, $coverage, $coveragePayment;
    public function __construct($coverage = NULL)
    {
        $this->coverage = $coverage;
        $this->coveragePayment = new CoveragePayment();
        $access_token = env('GC_ACCESS_TOKEN');
        $environment = env('GC_ENV', Environment::SANDBOX);
        $this->client = new Client(array(
            'access_token' => $access_token,
            'environment'  => $environment
        ));
    }

    public function createBillingRequest()
    {
        try {
            if (!$this->coverage->billing_request_id) {
                $sessionToken = Str::random(60);
                $billingRequestData = [
                    "params" => [
                        "payment_request" => [
                            "description" => "Upfront payment for Chelmsford Boiler Plan",
                            "amount" => $this->coverage->plan * 100,
                            "currency" => "GBP",
                            "app_fee" => $this->coverage->plan * 100,
                        ],
                        "mandate_request" => [
                            "scheme" => "bacs"
                        ],
                        'metadata' => [
                            'coverage_id' => (string) $this->coverage->id
                        ]
                    ]
                ];
                Log::channel('coverage')->info('Step 1/5 => ' . $this->coverage->id . ' => Billing Request Sent');
                $billingRequest = $this->client->billingRequests()->create($billingRequestData);
                Log::channel('coverage')->info('Step 1/5 => ' . $this->coverage->id . ' => Billing Response Recieved => ' . json_encode($billingRequest));
                $this->coverage->billing_request_id = $billingRequest->id;
            }
            $billingRequestFlowData = [
                "params" => [
                    "redirect_uri" => url('complete-payment?coverage=' . $this->coverage->id),
                    "exit_uri" => route('paymentError'),
                    "links" => [
                        "billing_request" => $this->coverage->billing_request_id,
                    ],
                ]
            ];
            Log::channel('coverage')->info('Step 2/5 => ' . $this->coverage->id . ' Billing FLow Request Sent');
            $billingRequestFlow = $this->client->billingRequestFlows()->create($billingRequestFlowData);
            Log::channel('coverage')->info('Step 2/5 => ' . $this->coverage->id . ' Billing FLow Response Recieved => ' . json_encode($billingRequestFlow));
            $this->coverage->redirect_url = $billingRequestFlow->authorisation_url;
            $this->coverage->save();
            $this->coverage = $this->coverage->fresh();

            return $this->coverage->redirect_url;
        } catch (Exception $e) {
            Log::channel('coverage')->info('Customer ID => ' . $this->coverage->id . " Billing Request Exception => " . $e->getMessage());
        }
    }


    public function completeRedirectFlow()
    {
        try {
            $response = $this->client->redirectFlows()->complete(
                $this->coverage->redirect_flow_id, //The redirect flow ID from above.
                ["params" => ["session_token" => $this->coverage->session_token]]
            );

            Log::channel('coverage')->info('Step 3/5 => ' . $this->coverage->id . " Billing Flow Completed");
            $this->coverage->mandate_id = $response->links->mandate;
            $this->coverage->save();
            return true;
        } catch (Exception $e) {
            Log::channel('coverage')->info('Redirect Flow => ' . json_encode($e->api_error));
            if ($e->api_error->errors[0]->reason == 'redirect_flow_already_completed')
                return true;
        }
    }

    public function createSubscription()
    {
        try {
            $key = Str::random(60);
            $amount = 2400;
            if ($this->coverage->plan == 174) {
                $amount = 4300;
            }
            $this->coverage->session_token = $key;
            $subscriptionData = [
                "params" => [
                    "amount" => $amount, // 15 GBP in pence
                    "currency" => "GBP",
                    "interval_unit" => "monthly",
                    "day_of_month" => "5",
                    "links" => [
                        "mandate" => $this->coverage->mandate_id
                        // Mandate ID from the last section
                    ],
                ],
                "headers" => [
                    "Idempotency-Key" => $key
                ]
            ];
            Log::channel('coverage')->info('Step 5/5 => ' . $this->coverage->id . ' Subscription Create Request Sent');
            $response = $this->client->subscriptions()->create($subscriptionData);
            Log::channel('coverage')->info('Step 5/5 => ' . $this->coverage->id . ' Subscription Create Response Recieved => ' . json_encode($response));
            $this->coverage->subscription_id = $response->id;
            $this->coverage->status = 'Paid';
            $this->coverage->save();
            return true;
        } catch (Exception $e) {
            Log::channel('coverage')->info('createSubscription => ' . json_encode($e->api_error));
            if ($e->api_error->errors[0]->reason == 'redirect_flow_already_completed')
                return true;
        }
    }

    public function createRedirectFlow()
    {
        if (!$this->coverage->redirect_flow_id) {
            $sessionToken = Str::random(60);
            $redirectFlow = $this->client->redirectFlows()->create([
                "params" => [
                    // This will be shown on the payment pages
                    "description" => "Initial Payment for Boiler Coverage",
                    // Not the access token
                    "session_token" => $sessionToken,
                    "success_redirect_url" => route('completePayment'),
                    // Optionally, prefill customer details on the payment page
                    "prefilled_customer" => [
                        "given_name" => head(explode(' ', $this->coverage->name)),
                        "family_name" => last(explode(' ', $this->coverage->name)),
                        "address_line1" => $this->coverage->address,
                        "postal_code" => $this->coverage->post_code
                    ]
                ]
            ]);
            $this->coverage->redirect_flow_id = $redirectFlow->id;
            $this->coverage->session_token = $sessionToken;
            $this->coverage->redirect_url = $redirectFlow->redirect_url;
            $this->coverage->save();
            $this->coverage = $this->coverage->fresh();
        }
        return $this->coverage->redirect_url;
    }

    public function createPayment()
    {
        $key = Str::random(60);
        $payment = $this->client->payments()->create([
            "params" => [
                "amount" => ((int) $this->coverage->plan) * 100, // In Pence
                "currency" => "GBP",
                "links" => [
                    "mandate" => $this->coverage->mandate_id
                    // The mandate ID from last section
                ],
            ],
            "headers" => [
                "Idempotency-Key" => $key
            ]
        ]);
        $coveragePayment = $this->coveragePayment->newInstance();
        $coveragePayment->idem_key = $key;
        $coveragePayment->payment_id = $payment->id;
        $coveragePayment->coverage_id = $this->coverage->id;
        $coveragePayment->save();
        return $coveragePayment;
    }

    public function getSubscriptionDetails()
    {
        if ($this->coverage->subscription_id) {
            $subscription = $this->client->subscriptions()->get($this->coverage->subscription_id);
            return $subscription;
        } else return false;
    }
}
