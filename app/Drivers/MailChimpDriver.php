<?php

namespace App\Drivers;

use Ixudra\Curl\Facades\Curl;

class MailChimpDriver
{
    private $url, $apiKey;

    public function __construct()
    {
        $this->url = env('MAILCHIMP_URL');
        $this->apiKey = "Basic " . env('MAILCHIMP_HASHED_KEY');
    }

    public function getLists()
    {
        $response = Curl::to($this->url . 'lists')
            ->withAuthorization($this->apiKey)->asJsonResponse()->get();
    }

    public function addNewMember($params, $subscribed = true)
    {
        $data = [
            "email_address" => $params['email'],
            "status" => 'subscribed',
            "tags" => ['Boiler Plan'],
            "merge_fields" => [
                "FNAME" => $params['name'],
                "LNAME" => $params['surname'],
                "MMERGE6" => "",
                "BIRTHDAY" => "",
                "POSTCODE" => $params['post_code'],
                "CUSTOMER" => "Customer",
                "SIGNUPDATE" => date('Y-m-d'),
                "REFERRER" => !empty($params['referred_by']) ? $params['referred_by'] : '',
                "BPOPTIN" => "No",
                "ADDRESS" => [
                    "addr1" => $params['address_1'],
                    "addr2" => $params['address_2'],
                    "city" => $params['town'],
                    "state" => $params['town'],
                    "zip" => $params['post_code'],
                    "country" => $params['county']
                ],
            ]
        ];
        $response = Curl::to($this->url . 'lists/b6e087c9b4/members')
            ->withAuthorization($this->apiKey)
            ->withData($data)
            ->asJsonRequest()
            ->asJsonResponse()
            ->returnResponseObject()
            ->post();
        if ($response->status == 200) {
            return $response->content;
        } else return false;
    }

    public function updateMemberInfo($params, $mailChimpInfo, $subscribed = true)
    {
        $data = [
            "list" => $mailChimpInfo->list_id,
            "status" => 'subscribed',
            "tags" => ['Boiler Plan'],
            "merge_fields" => [
                "FNAME" => $params['name'],
                "LNAME" => $params['surname'],
                "MMERGE6" => "",
                "BIRTHDAY" => "",
                "POSTCODE" => $params['post_code'],
                "CUSTOMER" => "Customer",
                "SIGNUPDATE" => date('Y-m-d'),
                "REFERRER" => !empty($params['referred_by']) ? $params['referred_by'] : '',
                "BPOPTIN" => $subscribed ? "Yes" : "No",
                "ADDRESS" => [
                    "addr1" => $params['address_1'],
                    "addr2" => $params['address_2'],
                    "city" => $params['town'],
                    "state" => $params['town'],
                    "zip" => $params['post_code'],
                    "country" => $params['county']
                ],
            ]
        ];
        $response = Curl::to($this->url . 'lists/b6e087c9b4/members/' . md5($params['email']))
            ->withAuthorization($this->apiKey)
            ->withData($data)
            ->asJsonRequest()
            ->asJsonResponse()
            ->returnResponseObject()
            ->patch();
        if ($response->status == 200) {
            return $response->content;
        } else return false;
    }

    public function getMember($email)
    {
        $response = Curl::to($this->url . "lists/b6e087c9b4/members/" . md5($email))
            ->withAuthorization($this->apiKey)
            ->asJsonResponse()
            ->returnResponseObject()
            ->get();
        if ($response->status == 200) {
            return $response->content;
        } else return false;
    }

    public function deleteMember($contactId)
    {
        $response = Curl::to($this->url . "lists/b6e087c9b4/members/" . md5($contactId) . ".actions/delete-permanent")
            ->withAuthorization($this->apiKey)
            ->asJsonResponse()
            ->post();
        return $response;
    }

    public function udpateTags($email)
    {
        $response = Curl::to($this->url . "lists/b6e087c9b4/members/" . md5($email))
            ->withAuthorization($this->apiKey)
            ->withData([
                "tags" => ['Boiler Plan', 'Boiler Plan Paid']
            ])
            ->asJsonRequest()
            ->asJsonResponse()
            ->returnResponseObject()
            ->patch();
    }

    public function updateGCError($error, $email)
    {
        $response = Curl::to($this->url . "lists/b6e087c9b4/members/" . md5($email))
            ->withAuthorization($this->apiKey)
            ->withData([
                "merge_fields" => [
                    "GCFAIL" => $error
                ]
            ])
            ->asJsonRequest()
            ->asJsonResponse()
            ->returnResponseObject()
            ->patch();
    }

    public function updatePostCodeMember()
    {
    }
    public function addNewMemberPostcodeMember($params)
    {
        $data = [
            "email_address" => $params['email'],
            "status" => 'subscribed',
            "tags" => ['out of area'],
            "merge_fields" => [
                "FNAME" => "",
                "LNAME" => "",
                "MMERGE6" => "",
                "BIRTHDAY" => "",
                "POSTCODE" => "",
                "CUSTOMER" => "Customer",
                "SIGNUPDATE" => date('Y-m-d'),
                "REFERRER" => "",
                "BPOPTIN" => "No",
                "BPOOAPC" => $params['post_code'],
                "ADDRESS" => "",
            ]
        ];
        $response = Curl::to($this->url . 'lists/b6e087c9b4/members')
            ->withAuthorization($this->apiKey)
            ->withData($data)
            ->asJsonRequest()
            ->asJsonResponse()
            ->returnResponseObject()
            ->post();
        if ($response->status == 200) {
            return $response->content;
        } else return false;
    }
}
