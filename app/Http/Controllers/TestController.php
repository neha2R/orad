<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\WebImport;
use Illuminate\Support\Facades\Http;
use paytm\paytmchecksum\PaytmChecksum;
use Symfony\Component\HttpFoundation\Request;
use App\Services\WhatsappService;
use Maatwebsite\Excel\Facades\Excel as MaatwebsiteExcel;
use App\Services\SmsService;
use App\Services\InappNotificationService;
// use Maatwebsite\Excel\Excel;

class TestController extends Controller
{
    public function test()
    {
        $url = "https://conference.livebox.co.in/livebox/appsservice/api/videoConfSettings";
        $ch = curl_init($url);

        $jsonData = array(

            'action' => 'Add',

            'username' => 'rajeev',

            'key' => 'admin',

            'name' => 'test',

            'selectPreset' => 'All',

            'Authentication' => 'false',

        );

        $jsonDataEncoded = json_encode($jsonData);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($ch);
        dd($result);
        $url = "https://conference.livebox.co.in/livebox/appsservice/api/videoConfSettings";
        $jsonData = array(

            'action' => 'Add',

            'username' => 'rajeev',

            'key' => 'admin',

            'name' => 'test',

            'selectPreset' => 'All',

            'Authentication' => 'false',

        );

        $jsonDataEncoded = json_encode($jsonData);
        $response = Http::post($url, $jsonData);
        dd($response->body());
    }
    public function test1()
    {
        $url = "https://conference.livebox.co.in/livebox/appsservice/api/videoConfSettings";
        $ch = curl_init($url);

        $jsonData = array(
            'name' => 'test',
            'action' => 'changeConferenceMode',
            'conferenceMode' => 'on',

            'username' => 'rajeev',

            'key' => 'admin',

        );

        $jsonDataEncoded = json_encode($jsonData);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($ch);
        dd($result);
    }

    public function paytmtest()
    {

//         $url=route('paytmpaymentcallback');
        //         $paytmParams = array();

//         $paytmParams["body"] = array(
        //             "mid" => "JODfTl60459964583598",
        //             "linkType" => "FIXED",
        //             "linkDescription" => "Test Payment",
        //             "linkName" => "Test",
        //             "amount"=>"1.00",
        //             "sendSms"=>true,
        //             "sendEmail"=>true,
        //             'statusCallbackUrl'=>"http://128.199.17.58/paytmpaymentcallback",
        //             "customerContact"=>array(
        //                 "customerName"=>"rahul",
        //                 "customerEmail"=>"rahul.modi@neologicx.com",
        //                 "customerMobile"=>9024829041
        //             )
        //         );

// /*
        //  * Generate checksum by parameters we have in body
        //  * Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys
        //  */
        //         $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), "Tm1@n@oeN5@j3#tT");

//         $paytmParams["head"] = array(
        //             "tokenType" => "AES",
        //             "signature" => $checksum,
        //         );

//         $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

// /* for Staging */
        //         // $url = "https://securegw-stage.paytm.in/link/create";

// /* for Production */
        //     $url = "https://securegw.paytm.in/link/create";

//         $ch = curl_init($url);
        //         curl_setopt($ch, CURLOPT_POST, true);
        //         curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //         curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        //         $response = curl_exec($ch);
        //         dd(json_decode($response));
        $amount=request()->get('amount');
        $paytmParams = array();
        $orderid='ORDERID_'.rand(20,200).'';
        $paytmParams["body"] = array(
            "requestType"   => "Payment",
            "mid"           => "JODfTl60459964583598",
            "websiteName"   => "DEFAULT",
            "orderId"       => $orderid,
            "callbackUrl"   => "https://merchant.com/callback",
            "txnAmount"     => array(
                "value"     => $amount,
                "currency"  => "INR",
            ),
            "userInfo"      => array(
                "custId"    => "CUST_001",
            ),
        );
        
        /*
        * Generate checksum by parameters we have in body
        * Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
        */
        $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), "Tm1@n@oeN5@j3#tT");
        
        $paytmParams["head"] = array(
            "signature"    => $checksum
        );
        
        $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
        
        /* for Staging */
        // $url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=YOUR_MID_HERE&orderId=ORDERID_98765";
        
        /* for Production */
        $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=JODfTl60459964583598&orderId=".$orderid."";
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 
        $response = curl_exec($ch);
        $response=json_decode($response);
        // dd($response->body->txnToken).;
        $token=$response->body->txnToken;
        
        return view('paymentprocess',compact('token','orderid'));

    }

    public function seniorexport()
    {
        return MaatwebsiteExcel::download(new UsersExport, 'seniorsales.xlsx');
    }

    public function sendtemplate()
    {
        return view('welcome');
    }

    public function submittemplate(Request $request)
    {
        // dd($request->);
        MaatwebsiteExcel::import(new WebImport, request()->file('importfile'));
        // WhatsappService::media($request->file('importfile'));
    }

    public function sendsms(){
        SmsService::demoassigntojrtrainer();
    }

}
