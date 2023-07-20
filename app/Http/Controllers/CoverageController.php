<?php

namespace App\Http\Controllers;

use App\Coverage;
use App\Drivers\GoCardlessDriver;
use App\Drivers\MailChimpDriver;
use App\PostCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CoverageController extends Controller
{
    private $coverage, $goCardlessDriver;
    public function __construct()
    {
        $this->coverage = new Coverage();
    }

    public function listing()
    {
        $coverages = $this->coverage->newQuery()->latest()->where('archive', false)->get();
        $coverageArchives = $this->coverage->newQuery()->latest()->where('archive', true)->get();
        return view('coverage.listing', compact('coverages', 'coverageArchives'));
    }

    public function details($id)
    {
        $coverage = $this->coverage->newQuery()->where('id', $id)->first();
        if (!$coverage) {
            return redirect()->back()->with('error', 'Coverage not found');
        }
        $goCardlessDriver = new GoCardlessDriver($coverage);
        $subscription = $goCardlessDriver->getSubscriptionDetails();
        return view('coverage.details', compact('coverage', 'subscription'));
    }

    public function index()
    {
        return view('coverage.index');
    }

    public function new()
    {
        return view('coverage.create');
    }

    public function create(Request $request)
    {
        $inputs = $request->all();
        // if ($this->coverage->newQuery()->where('email', $inputs['email'])->exists()) {
        //     return redirect()->back()->withInput()->with('error', 'Email already exists');
        // }
        $coverage = $this->coverage->newInstance();
        $coverage->fill($inputs);
        if ($coverage->save()) {
            return redirect()->to('/coverages')->with('success', 'Coverage added successfully');
        }
        return redirect()->back()->with('error', 'Unabled to create coverage! Please try again')->withInput();
    }

    public function update(Request $request)
    {
        $coverage = $this->coverage->newQuery()->where('id', $request->id)->first();
        if (!$coverage) {
            return redirect()->back()->with('error', 'Coverage not found');
        }
        $coverage->archive = $request->status == 'active' ? false : true;
        $coverage->save();
        return redirect()->back()->with('success', 'Coverage status updated successfully');
    }

    public function archive($id)
    {
        $coverage = $this->coverage->newQuery()->find($id);
        if (!$coverage) {
            return redirect()->back()->with('error', 'Coverage not found');
        }
        $coverage->archive = $coverage->archive ? false : true;
        $coverage->save();
        if ($coverage->archive) {
            $message = 'Coverage archived successfully';
        } else $message = 'Coverage restored successfully';
        return redirect()->back()->with('success', $message);
    }

    public function postCodeCheck(Request $request)
    {
        if (!empty($request->address)) {
            return response()->json(['error' => 'Address error']);
        }
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|recaptchav3:register,0.9'
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->first()], 400);
        }
        if ($request->email) {
            $mailChimp = new MailChimpDriver();
            if (!$mailChimp->getMember($request->email)) {
                $mailChimp->addNewMemberPostcodeMember($request->all());
            }
            return response()->json(['success' => true]);
        }
        $postCode = PostCode::where('boiler', true)->where(function ($q) use ($request) {
            for ($i = strlen($request->post_code); $i >= 2; $i--) {
                $q->orWhere('name', substr($request->post_code, 0, $i));
            }
        })->exists();
        if ($request->post_code && !$postCode) {
            return response()->json(['success' => false]);
        }
        session()->put('post_code', $request->post_code);
        return response()->json(['success' => true, 'html' => view('coverage.plan')->render()]);
    }

    public function selectPlan(Request $request)
    {
        session()->put('plan', $request->price);
        session()->put('marketing', $request->marketing);
        return response()->json(['success' => true, 'html' => view('coverage.information')->render()]);
    }

    public function checkEmail(Request $request)
    {
        return response()->json(['success' => true, 'url' => route('information')]);
        if (!$this->coverage->newQuery()->where('email', $request->email)->exists()) {
            return response()->json(['success' => true, 'url' => route('information')]);
        } else return response()->json(['success' => false, 'message' => 'Email already exists']);
    }


    public function information(Request $request)
    {
        $inputs = $request->all();
        $coverage = $this->coverage->newInstance();
        $coverage->fill($inputs);
        $coverage->marketing = session()->get('marketing') ? true : false;
        $coverage->save();
        $coverage = $coverage->fresh();
        $mailChimp = new MailChimpDriver();
        if ($res = $mailChimp->getMember($coverage->email)) {
            $res = $mailChimp->updateMemberInfo($coverage->toArray(), $res, $coverage->marketing);
        } else $res = $mailChimp->addNewMember($coverage->toArray(), $coverage->marketing);
        $coverage->mailchimp_contact_id = $res ? $res->contact_id : NULL;
        $coverage->save();
        return view('coverage.payment', compact('coverage'));
    }

    public function payment($id)
    {
        $coverage = $this->coverage->newQuery()->find($id);
        $this->goCardlessDriver = new GoCardlessDriver($coverage);
        $url = $this->goCardlessDriver->createBillingRequest();
        return redirect()->away($url);
    }

    public function completePayment(Request $request)
    {
        $billingRequestId = $request->coverage;
        $coverage = $this->coverage->newQuery()->where('id', $billingRequestId)->firstOrFail();
        Log::channel('coverage')->info('Step 3/5 => ' . $this->coverage->id . " Billing Flow Completed");
        session()->put('coverage', $coverage);
        if ($coverage->session_token) {
        }

        $mailChimp = new MailChimpDriver();
        $mailChimp->udpateTags($coverage->email);
        Http::post(env('ZAPPIER_HOOK'), [
            'coverage' => $coverage->toArray()
        ]);
        return redirect()->route('thankYou');
    }
    public function paymentError(Request $request)
    {
        // $billingRequestId = $request->coverage;
        // $coverage = $this->coverage->newQuery()->where('id', $billingRequestId)->firstOrFail();
        // session()->put('coverage', $coverage);
        // if ($coverage->session_token) {
        // }
        // Http::post('https://hooks.zapier.com/hooks/catch/12835012/bwfauj3/', [
        //     'payment' => [
        //         'status' => 'Pending',
        //         'name' => $coverage->name
        //     ]
        // ]);
        return view('coverage.payment-error');
    }

    public function thankYou()
    {
        return view('coverage.thank-you');
    }

    public function webhook(Request $request)
    {
        sleep(15);
        $events = json_decode(json_encode($request->events));
        $coverage = NULL;
        foreach ($events as $event) {
            if (!empty($event->links->billing_request) && !empty($event->links->mandate_request_mandate)) {
                Log::channel('coverage')->info('Step 4/5 => Webhook Response Recieved => ' . json_encode($request->all()));
                $coverage = $this->coverage->newQuery()->where('billing_request_id', $event->links->billing_request)->first();
                Log::channel('coverage')->info('Step 4/5 => Found Coverage against payment => ' . $coverage->id);
                if ($coverage->subscription_id && $coverage->status == 'Paid') {
                    return response()->json();
                }
                $coverage->mandate_id = $event->links->mandate_request_mandate;
                $coverage->save();
                break;
            }
        }
        if ($coverage) {
            $coverage = $coverage->fresh();
        }
        foreach ($events as $event) {
            if ($coverage && $event->action == 'failed') {
                Log::channel('coverage')->info('Step 4/5 => Found Coverage but payment failed against coverage => ' . $coverage->id);
                $coverage->status = 'failed';
                $coverage->save();
            }
        }

        if ($coverage) {
            $coverage = $coverage->fresh();
        }
        if ($coverage && $coverage->status == 'failed') {
            $coverage = $coverage->fresh();
            Log::channel('coverage')->info('Step 5/5 => Updated Mailchimp against failed payment => ' . $coverage->email);
            $mailChimp = new MailChimpDriver();
            $mailChimp->updateGCError('Payment Failed', $coverage->email);
        }
        if ($coverage && $coverage->status != 'failed') {
            $coverage = $coverage->fresh();
            $this->goCardlessDriver = new GoCardlessDriver($coverage);
            if (!$coverage->subscription_id) {
                $this->goCardlessDriver->createSubscription();
            }
        }
    }
}
