<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Demo;
use App\Models\Slot;
use App\Models\User;
use App\Models\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class SmsService
{
    public static function sendotp($mobile)
    {
        
        $rand=rand(000000,999999);
        $message='Welcome to ORAD world of learning,Your OTP for registeration is '.$rand.' ';
        $response = Http::get('http://bsnl.sms.gen.in/http-api.php?username=oraden&password=india2021&senderid=CLSENG&route=12&number='.$mobile.'&message='.$message.'');
        
        return 'done';
    }

    public static function sendsmsApi($mobile,$message){
        $username="A0eb5edae5035065e312f36fd81d12b79";
        $password="SRSTHA";
        // dd($message);
        $url="http://alerts.neologicx.com/api/web2sms.php";
         $response = Http::get($url, [
           'workingkey' => $username,
           'sender' => $password,
           'to'=>$mobile,
           'message'=>$message
        ]);
         ApiResponse::create(['mobile'=>$mobile,'apiresponse'=>$response->body(),'message'=>$message]);
    }


    public static function sendScholarsipLink($userid){
        $user = User::find($userid);
        $oradNumber = '7023257319';
        $oradEmail = 'info@orad.in';
        $date = '05 September 2021';
        $time = '12:00 PM';
        $name = $user->name;
        $email = $user->email;
        $mobile = $user->mobile;
        $url = route('login');
        $message=
        "Dear {$email},

This is an acknowledgement message to inform you that your registration for the exam has been completed successfully. Your exam is scheduled on {$date} at {$time}.
We wish you very good luck. Prepare well. 
Please click on the link below to open your ORAD account 
{$url}  
Username : {$email} 
Password : {$mobile} 
For any further queries you can reach us at {$oradNumber}  or {$oradEmail}";
        self::sendsmsApi($mobile,$message);
    }


    public static function sendDemolink($mobile,$email){
        $email='username:'.$email.'';
        $message="Hello ".$email." your password is ".$mobile."";
        self::sendsmsApi($mobile,$message);
    }

    public static function send(){
        $mobile=9024829041;
        $message="The demo of 123 was not successfully completed. Please check notification on app for feedback.";
        $response = Http::get('https://enterprise.smsgupshup.com/GatewayAPI/rest', [
            'method' => 'SendMessage',
            'send_to' => $mobile,
            'msg'=>$message,
            'msg_type'=>'TEXT',
            'userid'=>2000197901,
            'auth_scheme'=>'plain',
            'password'=>'5Lg6V8Hh',
            'v'=>1.1,
            'format'=>'text'
         ]);
        //  dd($response->body());


    }

    public static function demoassigntojrtrainer($name=null,$date=null,$time=null,$mobile=null){
        $message="A new demo for {$name} is assigned to you at {$date} on {$time} Thank you,Team ORAD";
        $response = Http::get('https://enterprise.smsgupshup.com/GatewayAPI/rest', [
            'method' => 'SendMessage',
            'send_to' => $mobile,
            'msg'=>$message,
            'msg_type'=>'TEXT',
            'userid'=>2000197901,
            'auth_scheme'=>'plain',
            'password'=>'Psaini@123',
            'v'=>1.1,
            'format'=>'text'
         ]);
        //  dd($response->body());
        ApiResponse::create(['mobile'=>$mobile,'apiresponse'=>$response->body(),'message'=>$message]);
    }

    public static function demoassigntosrtrainer($name=null,$date=null,$time=null,$mobile=null){
        $date=dateformater($date);
        $time=Slot::find($time)->from;
        $message="Demo for {$name} yet to be assigned to a trainer at {$time} on {$date} Thank you,Team ORAD";
        $response = Http::get('https://enterprise.smsgupshup.com/GatewayAPI/rest', [
            'method' => 'SendMessage',
            'send_to' => $mobile,
            'msg'=>$message,
            'msg_type'=>'TEXT',
            'userid'=>2000197901,
            'auth_scheme'=>'plain',
            'password'=>'Psaini@123',
            'v'=>1.1,
            'format'=>'text'
         ]);
        //  dd($response->body());
        ApiResponse::create(['mobile'=>$mobile,'apiresponse'=>$response->body(),'message'=>$message]);
    }

    public static function demoreassignjrmarketing($name,$trainername,$olddate,$newdate,$mobile){
        // $date=dateformater($date);
        // $time=Slot::find($time)->from;
        $oldtime=null;
        $newtime=null;
        $message="The demo of {$name} has been rescheduled by {$trainername} from {$olddate} {$oldtime} To {$newdate} & {$newtime}
        Thank you,
        Team ORAD";
        $response = Http::get('https://enterprise.smsgupshup.com/GatewayAPI/rest', [
            'method' => 'SendMessage',
            'send_to' => $mobile,
            'msg'=>$message,
            'msg_type'=>'TEXT',
            'userid'=>2000197901,
            'auth_scheme'=>'plain',
            'password'=>'Psaini@123',
            'v'=>1.1,
            'format'=>'text'
         ]);
         ApiResponse::create(['mobile'=>$mobile,'apiresponse'=>$response->body(),'message'=>$message]);

    }

    public static function demoreassignsrtrainer($mobile){
        $message="The demo of 123 has been rescheduled by you from 123 To 123 Thank you,Team ORAD";
       
    }

    public static function usercreated($id){
        $details=User::findorFail($id);
        $username=$details->email;
        $password=$details->mobile;
        $mobile=$details->mobile;
        $name=$details->name;
        $url=url('/');
$message= "Congratulations {$name}, Your ORAD account is created. Please click on the link below to login 
{$url}
Username: {$username}
Password: {$password}
Thank you,
Team ORAD";
            $response = Http::get('https://enterprise.smsgupshup.com/GatewayAPI/rest', [
                'method' => 'SendMessage',
                'send_to' => $mobile,
                'msg'=>$message,
                'msg_type'=>'TEXT',
                'userid'=>2000197901,
                'auth_scheme'=>'plain',
                'password'=>'Psaini@123',
                'v'=>1.1,
                'format'=>'text'
            ]);
         ApiResponse::create(['mobile'=>$mobile,'apiresponse'=>$response->body(),'message'=>$message]);
    }

    public static function demosuccessfull($userid,$trainerid){
        
        $mobile=9024829041;
        $trainername=User::findorFail($trainerid)->name;
        $username=User::findorFail($userid);
        $trainerid=$username->stakeholders()->unique()->values()->all();
        if(array_key_exists(1,$trainerid)){
            $trainerid=$trainerid[1];
            $trainernumber=User::findorFail($trainerid)->mobile;
        }
        $message="{$trainername} has successfully completed the assigned demo of {$username->name}
        Thank you,
        Team ORAD";

        $response = Http::get('https://enterprise.smsgupshup.com/GatewayAPI/rest', [
            'method' => 'SendMessage',
            'send_to' => $trainernumber,
            'msg'=>$message,
            'msg_type'=>'TEXT',
            'userid'=>2000197901,
            'auth_scheme'=>'plain',
            'password'=>'Psaini@123',
            'v'=>1.1,
            'format'=>'text'
        ]);
     ApiResponse::create(['mobile'=>$trainernumber,'apiresponse'=>$response->body()]);
    }

    public static function clientcoldcall($jrmarketingname,$jrmarketingnumber,$mobile){
      $message=  "Greetings from ORAD,
Thank you for having an interaction with our counsellor {$jrmarketingname} and giving us your precious time. Book our ONE DAY live 1:1 training session absolutely FREE!!! Our goal is to provide you a highly customized and unique experience while improving your English proficiency. For booking an absolutely free 1:1 live demo session please visit our website or give us a call. www.orad.in 
{$jrmarketingname}
{$jrmarketingnumber}
Counsellor
ORAD CONSULTANCY";
$response = Http::get('https://enterprise.smsgupshup.com/GatewayAPI/rest', [
    'method' => 'SendMessage',
    'send_to' => $mobile,
    'msg'=>$message,
    'msg_type'=>'TEXT',
    'userid'=>2000197901,
    'auth_scheme'=>'plain',
    'password'=>'Psaini@123',
    'v'=>1.1,
    'format'=>'text'
]);
 ApiResponse::create(['mobile'=>$mobile,'apiresponse'=>$response->body(),'message'=>$message]);

    }

    public static function clienthotcall($jrmarketingname,$jrmarketingnumber,$mobile,$name){
      $message=  
"Dear {$name},
Thank you for having an interaction with {$jrmarketingname}.
Soon you will receive confirmation of your free live 1:1 class with our experienced and professional trainer on the date and time of your choice.
Our one day live 1:1 training session is absolutely FREE!!!
Note:- A laptop/computer or a smartphone/tablet with stable internet connection is required to attend the demo session.
Thank you,
{$jrmarketingname}
{$jrmarketingnumber}
Counsellor
ORAD CONSULTANCY";
$response = Http::get('https://enterprise.smsgupshup.com/GatewayAPI/rest', [
    'method' => 'SendMessage',
    'send_to' => $mobile,
    'msg'=>$message,
    'msg_type'=>'TEXT',
    'userid'=>2000197901,
    'auth_scheme'=>'plain',
    'password'=>'Psaini@123',
    'v'=>1.1,
    'format'=>'text'
]);
 ApiResponse::create(['mobile'=>$mobile,'apiresponse'=>$response->body(),'message'=>$message]);

    }

    public static function clientwarmcall($username,$trainername,$trainernumber,$mobile){
        $message="Dear {$username},
        Thank you for having a conversation with our counsellor {$trainername}. We are grateful that you are interested in taking up our course.
        Book our one day live 1:1 training session absolutely free.
        For further information about us or our courses feel free to contact our counsellor or visit our website www.orad.in
        Regards,
        {$trainername}
        {$trainernumber}
        Counsellor
        ORAD CONSULTANCY";
        $response = Http::get('https://enterprise.smsgupshup.com/GatewayAPI/rest', [
            'method' => 'SendMessage',
            'send_to' => $mobile,
            'msg'=>$message,
            'msg_type'=>'TEXT',
            'userid'=>2000197901,
            'auth_scheme'=>'plain',
            'password'=>'Psaini@123',
            'v'=>1.1,
            'format'=>'text'
        ]);
         ApiResponse::create(['mobile'=>$mobile,'apiresponse'=>$response->body(),'message'=>$message]);
    }

    public static function clientassignedtrainer($username,$trainername,$trainernumber,$mobile,$date,$time){
       $message= 
"Dear {$username},
As per your request we have booked a free demo session for you on {$date} at {$time} with one of our most experienced and highly educated trainer {$username}.
You will soon receive a link to connect in the session.
Note: -A laptop/computer or a smartphone/tablet with stable internet connection is required to attend the demo session.
Thank you,
{$trainername}
{$trainernumber}
ORAD CONSULTANCY";
        $response = Http::get('https://enterprise.smsgupshup.com/GatewayAPI/rest', [
            'method' => 'SendMessage',
            'send_to' => $mobile,
            'msg'=>$message,
            'msg_type'=>'TEXT',
            'userid'=>2000197901,
            'auth_scheme'=>'plain',
            'password'=>'Psaini@123',
            'v'=>1.1,
            'format'=>'text'
        ]);
         ApiResponse::create(['mobile'=>$mobile,'apiresponse'=>$response->body(),'message'=>$message]);
    }

    public static function clientrescheduling($username,$date,$time,$mobile){
        $url=url('/')."/login";
        $message="
        Dear {$username},
        Your free demo session has been rescheduled as per your request. Your next free demo session is on {$date} at {$time}.
        You can connect to your ORAD account using {$url}
        You will soon receive a link to connect in the session.
        Our one day live 1:1 training session is absolutely FREE!!!
        Note:- you must have a stable internet enabled Laptop/PC or Smartphone to attend this demo session.
        Thank you,
        ORAD CONSULTANCY";
        $response = Http::get('https://enterprise.smsgupshup.com/GatewayAPI/rest', [
            'method' => 'SendMessage',
            'send_to' => $mobile,
            'msg'=>$message,
            'msg_type'=>'TEXT',
            'userid'=>2000197901,
            'auth_scheme'=>'plain',
            'password'=>'Psaini@123',
            'v'=>1.1,
            'format'=>'text'
        ]);
         ApiResponse::create(['mobile'=>$mobile,'apiresponse'=>$response->body(),'message'=>$message]);
    }

    public static function clientsendlink($demoid,$trainername,$demolink){
        $demo=Demo::findorFail($demoid);
        $user=User::findorFail($demo->leadid);
        $mobile=$user->mobile;
        $formatteddate=dateformater($demo->date);
        $url=url('/')."/login";
        $time=Slot::findorFail($demo->slot);
        $message=
        "Dear {$user->name},
        Your top certified Spoken English Trainer {$trainername} will be there for you in your personalized Spoken English class on {$formatteddate} at {$time->from}.
        You can join the class here {$demolink},
        You can connect to your ORAD account using {$url}
        Our one day live 1:1 training session is absolutely free.
        For any information contact or visit our website
        REGARDS
        ORAD CONSULTANCY";
        $response = Http::get('https://enterprise.smsgupshup.com/GatewayAPI/rest', [
            'method' => 'SendMessage',
            'send_to' => $mobile,
            'msg'=>$message,
            'msg_type'=>'TEXT',
            'userid'=>2000197901,
            'auth_scheme'=>'plain',
            'password'=>'Psaini@123',
            'v'=>1.1,
            'format'=>'text'
        ]);
         ApiResponse::create(['mobile'=>$mobile,'apiresponse'=>$response->body(),'message'=>$message]);
    }

    public static function clientfeedback($id,$trainername,$trainernumber){
        $user=User::findorFail($id);
        $mobile=$user->mobile;
      $message=  "Dear {$user->name},
        You have successfully completed your live 1:1 demo class with {$trainername}. For downloading its certificate please log in to your ORAD Account using Login link
        Please fill the feedback form also.
        For more details about the courses please contact our counselor or visit our website.
        Regards,
        {$trainername}
        {$trainernumber}
        ORAD Consultancy";

        $response = Http::get('https://enterprise.smsgupshup.com/GatewayAPI/rest', [
            'method' => 'SendMessage',
            'send_to' => $mobile,
            'msg'=>$message,
            'msg_type'=>'TEXT',
            'userid'=>2000197901,
            'auth_scheme'=>'plain',
            'password'=>'Psaini@123',
            'v'=>1.1,
            'format'=>'text'
        ]);
         ApiResponse::create(['mobile'=>$mobile,'apiresponse'=>$response->body(),'message'=>$message]);
    }

    public static function paymentinfo($id,$paymentid){
        $user=User::findorFail($id);
        $lang=$user->lang;
        $mobile=$user->mobile;
        $username=$user->name;
        $link=url('/')."/login";
        $paymentlink=route('billing',['id'=>encrypt($paymentid)]);
        $message="Dear {$username},
        Thank you for being our valued customer. We have received your payment.
        Please login to your ORAD account using the link to start your learning journey with ORAD. {$link}
        Your classes will start from your desired date and time.
        Note:- You can download the payment receipt from this link.
        {$paymentlink}
        For any queries or details please contact us.
        REGARDS,
        ORAD CONSULTANCY";
        $response = Http::get('https://enterprise.smsgupshup.com/GatewayAPI/rest', [
            'method' => 'SendMessage',
            'send_to' => $mobile,
            'msg'=>$message,
            'msg_type'=>'TEXT',
            'userid'=>2000197901,
            'auth_scheme'=>'plain',
            'password'=>'Psaini@123',
            'v'=>1.1,
            'format'=>'text'
        ]);
         ApiResponse::create(['mobile'=>$mobile,'apiresponse'=>$response->body(),'message'=>$message]);
    } 

   

   
}
