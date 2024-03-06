<?php

namespace App\Services;

use paytm\paytmchecksum\PaytmChecksum;

class PaytmService
{
    public static function createLink($name, $mobile, $email, $amount)
    {
        $url = route('paytmpaymentcallback');
        $paytmParams = array();

        if ($amount == 11223344) {
            $amount = 1;
        }
        $paytmParams["body"] = array(
            "mid" => "JODfTl60459964583598",
            "linkType" => "FIXED",
            "linkDescription" => "For Orad Classes",
            "linkName" => "Orad",
            "amount" => $amount,
            "sendSms" => true,
            "sendEmail" => true,
            "statusCallbackUrl" => "https://orad.in/paytmpaymentcallback",
            "customerContact" => array(
                "customerName" => $name,
                "customerEmail" => $email,
                "customerMobile" => $mobile,
            ),
        );

/*
 * Generate checksum by parameters we have in body
 * Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys
 */
        $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), "Tm1@n@oeN5@j3#tT");

        $paytmParams["head"] = array(
            "tokenType" => "AES",
            "signature" => $checksum,
        );

        $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

/* for Staging */
        // $url = "https://securegw-stage.paytm.in/link/create";

/* for Production */
        $url = "https://securegw.paytm.in/link/create";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $response = curl_exec($ch);
        // Log.debug();
        return $response;
        dd(json_decode($response));
    }

    public static function expireLink($linkid)
    {

        $paytmParams = array();
        $paytmParams["body"] = array(
            "mid" => "JODfTl60459964583598",
            "linkId" => $linkid,

        );

        // dd($paytmParams);
        /*
         * Generate checksum by parameters we have in body
         * Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys
         */
        $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), "Tm1@n@oeN5@j3#tT");

        $paytmParams["head"] = array(
            "tokenType" => "AES",
            "signature" => $checksum,
        );

        $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

/* for Staging */
        // $url = "https://securegw-stage.paytm.in/link/create";

/* for Production */
        $url = "https://securegw.paytm.in/link/create";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $response = curl_exec($ch);
        return $response;
    }

    public static function initiatePayment()
    {
        $paytmParams = array();

        $paytmParams["body"] = array(
            "requestType" => "Payment",
            "mid" => "JODfTl60459964583598",
            "websiteName" => "WEBSTAGING",
            "orderId" => "ORDERID_98765",
            "callbackUrl" => "https://merchant.com/callback",
            "txnAmount" => array(
                "value" => "1.00",
                "currency" => "INR",
            ),
            "userInfo" => array(
                "custId" => "CUST_001",
            ),
        );

/*
 * Generate checksum by parameters we have in body
 * Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys
 */
        $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), "Tm1@n@oeN5@j3#tT");

        $paytmParams["head"] = array(
            "signature" => $checksum,
        );

        $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

/* for Staging */
        // $url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=YOUR_MID_HERE&orderId=ORDERID_98765";

/* for Production */
$url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $response = curl_exec($ch);
        print_r($response);
    }
}
