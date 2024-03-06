<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LeadStatus;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Models\CoursePayments;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use paytm\paytmchecksum\PaytmChecksum;
use App\Services\InappNotificationService;

class PaytmController extends Controller
{
    public function callback(Request $request){
      try {
        $respcode=$request->RESPCODE;
        if ($respcode == 01) {
         $orderid=$request->ORDERID;
         $course= CoursePayments::where(['order_id'=>$orderid])->first();
         LeadStatus::where('leadid',$course->lead_id)->update(['is_paid'=>1]);
         $course->update(['paytm_response_raw'=>json_encode($request),'payment_success'=>1]);
         WhatsappService::sendpaymentinfo($course->lead_id,$course->id);
         SmsService::paymentinfo($course->lead_id,$course->id);
         InappNotificationService::paymentdone($course->id);
         return view('payments.paymentstatus')->with(['status'=>1,'orderid'=>$orderid,'amount'=>$course->discounted_price]);
        }else{
          $orderid=$request->ORDERID;
          $course= CoursePayments::where(['order_id'=>$orderid])->update(['paytm_response_raw'=>json_encode($request),'payment_success'=>0]);
          $course= CoursePayments::where(['order_id'=>$orderid])->first();
          return view('payments.paymentstatus')->with(['status'=>1,'orderid'=>$orderid,'amount'=>$course->discounted_price]);
        }


      } catch (\Throwable $th) {
          // dd($th);
          Log::critical($th);
      }
        
    }

    public function paymentview($id){
      // $id = Crypt::Encrypt($id);
      $id=decrypt($id);
      $data=CoursePayments::findorFail($id);
      $trainerid=$data->leadstatus ? $data->leadstatus->assignedto : 0;
      
      $trainer=User::findorFail($trainerid)->name;
      return view('payments.payment',compact('data','trainer'));
    }

   

    public function initalpayment(Request $request,$id){
      
      $id=decrypt($id);
      $amount=CoursePayments::findorFail($id)->discounted_price;
      // $amount="1";
      $paytmParams = array();
      $orderid='ORDERID_'.strtotime("now").'000'.$id.'';
      // $orderid='ORDERID_98765';
      $paytmParams["body"] = array(
          "requestType"   => "Payment",
          "mid"           => "JODfTl60459964583598",
          "websiteName"   => "DEFAULT",
          "orderId"       => $orderid,
          "callbackUrl"   => "https://orad.in/paytmpaymentcallback",
          "txnAmount"     => array(
              "value"     => $amount,
              "currency"  => "INR",
          ),
          "userInfo"      => array(
              "custId"    => "CUST_001",
          ),
      );
      CoursePayments::findorFail($id)->update(['order_id'=>$orderid]);
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
      // $url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=fFTVLA12179776945768&orderId=$orderid";
      
      /* for Production */
      $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=JODfTl60459964583598&orderId=".$orderid."";
      
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
      curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 
      $response = curl_exec($ch);
      $response=json_decode($response);
      // dd($response);
      $token=$response->body->txnToken;
      return view('paymentprocess',compact('token','orderid'));
    }


    public function callbacklocal(Request $request){
      try {
        $respcode=$request->RESPCODE;
        
        if (1) {
         $data=['ORDERID_162619942300011','ORDERID_162619942300012'
            ,'ORDERID_162619942300013'
            ,'ORDERID_162619942300014'
            ,'ORDERID_162619942300015'
            ,'ORDERID_162619942300016'
            ,'ORDERID_162619942300017'
            ,'ORDERID_162619942300018'
            ,'ORDERID_162619942300019'
            ,'ORDERID_162619942300020'
            ,'ORDERID_162619942300021'
          
          ]; 
          foreach ($data as $key => $value) {
            $orderid=$value;
         $course= CoursePayments::where(['order_id'=>$orderid])->first();
         LeadStatus::where('leadid',$course->lead_id)->update(['is_paid'=>1]);
         $course->update(['paytm_response_raw'=>json_encode($request),'payment_success'=>1]);
         WhatsappService::sendpaymentinfo($course->lead_id,$course->id);
         SmsService::paymentinfo($course->lead_id,$course->id);
         InappNotificationService::paymentdone($course->id);
        //  return view('payments.paymentstatus')->with(['status'=>1,'orderid'=>$orderid,'amount'=>$course->discounted_price]);
          }
         
        }else{
          $orderid=$request->ORDERID;
          $course= CoursePayments::where(['order_id'=>$orderid])->update(['paytm_response_raw'=>json_encode($request),'payment_success'=>0]);
          $course= CoursePayments::where(['order_id'=>$orderid])->first();
          return view('payments.paymentstatus')->with(['status'=>1,'orderid'=>$orderid,'amount'=>$course->discounted_price]);
        }


      } catch (\Throwable $th) {
          dd($th);
          Log::critical($th);
      }
        
    }

}
