<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\Demo;
use App\Models\Slot;
use App\Models\User;
use App\Models\ApiResponse;
use App\Models\CoursesType;
use App\Models\LeadMessages;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class WhatsappService
{
    public $message;
    public $apiusername;
    public $apipassword;

    public function __construct()
    {
        $this->apiusername = '2000195584';
        $this->apipassword = '#x6XnQd2';

    }

    public static function optin($mobilenumber)
    {

        try {
            $response = Http::get('https://media.smsgupshup.com/GatewayAPI/rest', [
                'userid' => '2000197548',
                'password' => '2!uVtr6f',
                'phone_number' => '91' . $mobilenumber,
                'method' => 'OPT_IN',
                'auth_scheme' => 'plain',
                'v' => 1.1,
                'channel' => 'whatsapp',
                'format' => 'json',
            ]);
            $data = json_decode($response->body());
            $status = $data->response->status;
            Log::debug(['type' => 'optin', 'mobile' => $mobilenumber, 'response' => $data, 'status' => $status]);
            
            if ($status == 'success') {
                return 1;
            } else {
                $response = $data->response->id;
                switch ($status) {
                    case 100:
                        return 0;
                        break;
                    case 101:
                        return 0;
                        break;
                    case 102:
                        return 0;
                        break;
                    case 103:
                        return 0;
                        break;
                    case 105:
                        return 0;
                        break;
                    case 106:
                        return 0;
                        break;
                    case 175:
                        return 0;
                        break;
                    case 312:
                        return 1;
                        break;
                    default:
                        return 0;
                        break;
                }
            }
        } catch (\Throwable $th) {
            // dd($th);
        }
    }

    public static function sendmediamessage($message = null, $mobilenumber)
    {
        $response = Http::get('https://media.smsgupshup.com/GatewayAPI/rest', [
            'userid' => '2000197548',
            'password' => '2!uVtr6f',
            'method' => 'SendMediaMessage',
            'auth_scheme' => 'plain',
            'v' => 1.1,
            'send_to' => '91' . $mobilenumber,
            'caption' => $message,
            'media_id' => '8gB98N7pKUDINZk6TmdIHB1N77STq5C454dwd96K0qod0K_QjuAGrX3MlWZJLloMkGd4gFpm791DF4jctiPuZyDIsSK1HJ2Ckn6vycY',
            'msg_type' => 'IMAGE',
            'isHSM' => true,
            'isTemplate' => false,
            'data_encoding' => 'Text',
            'format' => 'json',
            'filename' => 'orad',
        ]);
        // dd($response->body());
        return $response->body();
    }

    public static function sendmessage($message = null, $mobilenumber)
    {
        // dd($message,$mobilenumber);
        // $url="https://media.smsgupshup.com/GatewayAPI/rest?userid=2000197548&password=2%21uVtr6f&method=SendMessage&auth_scheme=plain&v=1.1&send_to=9024829041&msg={$msg}&msg_type=HSM&isHSM=true&isTemplate=true&data_encoding=Text&format=json";
        $response = Http::get('https://media.smsgupshup.com/GatewayAPI/rest', [
            'userid' => '2000197548',
            'password' => '2!uVtr6f',
            'method' => 'SendMessage',
            'auth_scheme' => 'plain',
            'v' => 1.1,
            'send_to' => '91' . $mobilenumber,
            'msg' => $message,
            'msg_type' => 'HSM',
            'isHSM' => true,
            'isTemplate' => false,
            'data_encoding' => 'Text',
            'format' => 'json',
            // 'buttonUrlParam'=>'home'
        ]);
        // dump($response->body());
        ApiResponse::create(['mobile'=>$mobilenumber,'apiresponse'=>$response->body(),'message'=>$message]);
        // Log::debug(['type' => 'optin', 'mobile' => $mobilenumber, 'response' => $response->body()]);
    }

    public static function sendScholarshipWhatsappMsg($userid)
    {
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
        self::sendmessageUrlencode($message,$mobile);
    }

    public static function sendExamWhatsappMsg($userid)
    {
        $user = User::find($userid);
        $oradNumber = '7023257319';
        $oradEmail = 'info@orad.in';
        $date = 'Date 05 September';
        $time = '01:00 PM';
        $name = $user->name;
        $email = $user->email;
        $mobile = $user->mobile;
        $url = route('login');
        $message=
"Dear {$name},
Greetings of the day ! 

So finally {$date} is knocking the door. 

Your test time is {$time}. 
Are you all excited for ORAD LITTLE CHAMP TEST or you're panicking ? 
No worries , just take a deep breath it's just a simple English proficiency test where you don't have to prepare anything . For further details we have attached the PDFs on your registered email, just go through them carefully before the test . 

For opening the test you need to login your ORAD account here. 
{$url}

Please login from your registered number. 

Wish you all the very best.";
        self::sendmessageUrlencode($message,$mobile);
    }

    public static function sendmessageUrlencode($message,$mobilenumber){
        $revert = array('%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')', '%0D' => '');
        $msg = strtr(rawurlencode($message), $revert);
        $url="https://media.smsgupshup.com/GatewayAPI/rest?userid=2000197548&password=2%21uVtr6f&method=SendMessage&auth_scheme=plain&v=1.1&send_to=91{$mobilenumber}&msg={$msg}&msg_type=HSM&isHSM=true&isTemplate=true&data_encoding=Text&format=json";
        $response = Http::get($url);
        
        // dd($response->body());
        ApiResponse::create(['mobile'=>$mobilenumber,'apiresponse'=>$response->body(),'message'=>$msg]);
    }

    public static function sendmessagealternate($message,$mobilenumber){
        $revert = array('%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')', '%0D' => '');
        $msg = strtr(rawurlencode($message), $revert);
        $url="https://media.smsgupshup.com/GatewayAPI/rest?userid=2000197548&password=2%21uVtr6f&method=SendMessage&auth_scheme=plain&v=1.1&send_to=91{$mobilenumber}&msg={$msg}&msg_type=HSM&isHSM=true&data_encoding=Text&format=json";
        $response = Http::get($url);
        // dd($response->body());
        ApiResponse::create(['mobile'=>$mobilenumber,'apiresponse'=>$response->body(),'message'=>$msg]);
    }

    public static function media($filepath)
    {

        $curl = curl_init();

        $File = new \CURLFile($filepath, "document", "orad.jpeg");
        $ch = curl_init();
        $array = array('userid' => '2000197548', 'password' => '2!uVtr6f', 'method' => 'UploadMedia', 'auth_scheme' => 'plain', 'v' => '1.1', 'media_type' => 'IMAGE', 'media_file' => $File, 'format' => 'json');
        curl_setopt($ch, CURLOPT_URL, "https://media.smsgupshup.com/GatewayAPI/rest");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($curl_scraped_page);

        $mediaid = $response->response->id;
        // dd($response);
    }

public static function sendpaymentlink($userid,$courseid,$price,$link,$marketingname,$marketingnumber){
    $baseurl=url('/');
    $shorturl="{$baseurl}/short-url/{$link}";
    $user=User::findorFail($userid);
    $cou=CoursesType::findorFail($courseid);
    $days="{$cou->days} days";
    switch ($user->lang) {
        case 0:
$message=
"Dear *{$user->name}*,

Your trust means the world to us. Thank you for giving us the honor to serve you.

As you are done with your demo session and want to continue your course, we request you to click on the link below for payment for the *{$cou->Course->name}* *{$cou->name}* *{$days}* course for which your discounted price is INR *{$price}*.
{$shorturl} 

If you are stuck anywhere do contact us

REGARDS,
{$marketingname}
{$marketingnumber}
Counsllor
ORAD CONSULTANCY";
            break;
        case 1:
$message="प्रिय *{$user->name}*,
हमारे course में आपकी रुचि के लिये धन्यवाद।
आपके चुने हुए  *{$cou->Course->name}* *{$cou->name}* *30* course के लिए धनराशि ₹ *{$price}* का भुगतान आप नीचे दी हुई link से कर सकते हैं।
{$shorturl}
इसमें किसी समस्या निवारण  के लिये आप हमारे सलाहकार से संपर्क कर सकते हैं।
धन्यवाद,
*{$marketingname}*
*{$marketingnumber}*
सलाहकार
ORAD CONSULTANCY";
            break;
        default:
$message=
"Dear *{$user->name}*,

Your trust means the world to us. Thank you for giving us the honor to serve you.

As you are done with your demo session and want to continue your course, we request you to click on the link below for payment for the *{$cou->Course->name}* *{$cou->name}* *{$days}* course for which your discounted price is INR *{$price}*.
{$shorturl} 

If you are stuck anywhere do contact us

REGARDS,
{$marketingname}
{$marketingnumber}
Counsllor
ORAD CONSULTANCY";
            break;
    }
    
    self::sendmessage($message,$user->whatsappnumber ?? $user->mobile);
}

public static function resendpaymentlink($userid,$courseid,$price,$link,$marketingname,$marketingnumber){
    $baseurl=url('/');
    $shorturl="{$baseurl}/short-url/{$link}";
    $user=User::findorFail($userid);
    $cou=CoursesType::findorFail($courseid);
    $days="{$cou->days} days";
    switch ($user->lang) {
        case 0:
$message=
"Dear *{$user->name}*,

Your trust means the world to us. Thank you for giving us the honor to serve you.

As you are done with your demo session and want to continue your course, we request you to click on the link below for payment for the *{$cou->Course->name}* *{$cou->name}* *{$days}* course for which your discounted price is INR *{$price}*.
{$shorturl} 

If you are stuck anywhere do contact us

REGARDS,
{$marketingname}
{$marketingnumber}
Counsllor
ORAD CONSULTANCY";
            break;
        
        default:
           
            break;
    }

    self::sendmessage($message,$user->mobile);
}

    public static function senddemolink($demoid, $trainername, $demolink)
    {
        $demo = Demo::find($demoid);
        $userid = $demo->leadid;
        $user = User::find($userid);
        $name = $user->name;
        $rooturl = url('/');
        $url = "{$rooturl}/login";
        $contactnumber = "7023257320";
        $date = $demo->date;
        $slot = Slot::find($demo->slot);
        $slot = "{$slot->from}";
        switch (1) {
            case 0:
$message = 
"Dear *{$name}*,
Your top certified Spoken English Trainer *{$trainername}* will be there  for you in your personalized Spoken English class on *{$date}* at *{$slot}*.
You can join the class here link {$demolink}
You can connect to your ORAD account using Log in link {$url}
*Our one day live 1:1 training session is absolutely free.* 
For any information contact or visit our website 
REGARDS
ORAD CONSULTANCY";


                break;
            case 1:
$message = 
"Dear *{$name}*,
Your top certified Spoken English Trainer *{$trainername}* will be there  for you in your personalized Spoken English class on *{$date}* at *{$slot}*.
You can join the class here link {$demolink}
You can connect to your ORAD account using Log in link {$url}
*Our one day live 1:1 training session is absolutely free.* 
For any information contact or visit our website 
REGARDS
ORAD CONSULTANCY";

                break;
            default:
               
                break;
        }

        self::sendmessagealternate($message,$user->mobile);

    }




public static function callmessages($userid,$leadtype,$trainername='',$trainernumber='',$lang){
$user=User::findorFail($userid);
$username=$user->name;
$mobile=$user->whatsappnumber ? $user->whatsappnumber : $user->mobile;

    switch ($leadtype) {
        case 2:
            if ($lang) {
$message="\"नमस्कार!
हमारे सलाहकार से बातचीत  करने  के लिये धन्यवाद। यदि आप अपने या अपने बेटे/बेटी के  भविष्य, करियर और अंग्रेजी से जुड़ी समस्या का हल चाहते हैं तो कृपया हमसे सम्पर्क करें।
आप हमारे 1:1 (यानी एक विद्यार्थी के लिए एक ही शिक्षक) का घर बैठे मुफ्त  demo क्लास ले सकते हैं, जिससे आप बेहतर समझेंगे  की आपको  या आपके बेटे/बेटी को अंग्रेजी मे क्या समस्या है और उसका हल हम कैसे करेंगे।
*एक दिन का क्लास बिलकुल मुफ्त है।*
नोट:– online demo session में जुड़ने के लिए आपके स्मार्टफोन या लैपटॉप/कंप्यूटर के साथ इंटरनेट होना आवश्यक है।
अधिक जानकारी के लिये कृपया हमारी वेबसाइट पर जायें।
धन्यवाद!!
*{$trainername}*
*{$trainernumber}*      
सलाहकार
ORAD CONSULTANCY";
            }else{
$message="Greetings from ORAD,
Thank you for having an interaction with our counsellor *{$trainername}* and giving us your precious time.
We feel fortunate to receive queries from your end and assure you that we will try our best to resolve all your career related problems.
*Book our ONE DAY live 1:1 training session absolutely FREE!!!*
Our goal is to provide you a highly customized and unique experience while improving your English proficiency.
For booking an absolutely free 1:1 live demo session please visit our website or give us a call. We are available 24*7 to address all your queries.
Note: A laptop/computer or a smartphone/tablet with stable internet connection is required to attend the demo session.
Regards,
*{$trainername}*
*{$trainernumber}*
Counsellor
ORAD CONSULTANCY";
            }
            // self::sendmessageUrlencode($message,$mobile);
            SmsService::clientcoldcall($trainername,$trainernumber,$mobile);
            LeadMessages::create(['leadid'=>$userid,'message'=>'Cold Sms Sent to client.','message_type'=>1]);
            break;
        case 3:
            if ($lang) {
$message="नमस्कार!
हमारे सलाहकार *{$trainername}* से बात करने व हमारी सेवाओं में रुचि लेने के लिये धन्यवाद। हम घर बैठे आप के बेटे/बेटी की भविष्य, करियर और अंग्रेजी से जुड़ी समस्या हल करने का हरसंभव प्रयास करेंगे ।
कृपया आप हमारे 1:1 (यानी एक विद्यार्थी के लिए एक ही शिक्षक) का घर बैठे मुफ्त demo क्लास ले जिससे आप बेहतर समझ पाएंगे की आपके बेटे/बेटी को अंग्रेजी भाषा में क्या समस्या है, और उसका हल हम कैसे करेंगे।
*एक दिन का क्लास बिलकुल मुफ्त है।*
नोट:– demo session में जुड़ने के लिए आपके पास इंटरनेट वाले स्मार्टफोन या फिर लैपटॉप/कंप्यूटर की जरूरत पड़ेगी।
अधिक जानकारी के लिये आप हमारी वेबसाइट पर जा सकते हैं या हमें फोन कर सकते है।
धन्यवाद,
*{$trainername}*
*{$trainernumber}*
सलाहकार
ORAD CONSULTANCY"; 
            } else {
$message="\"Dear *{$username}*,
Thank you for having a conversation with our counsellor *{$trainername}*. We are grateful that you are interested in taking up our course.
*Book our one day live 1:1 training session absolutely free*
For further information about us or our courses feel free to contact our counsellor or visit our website. 
Regards,
*{$trainername}*
*{$trainernumber}*
Counsellor
ORAD CONSULTANCY";
            }
            
            self::sendmessageUrlencode($message,$mobile);
            SmsService::clientwarmcall($username,$trainername,$trainernumber,$mobile);
            LeadMessages::create(['leadid'=>$userid,'message'=>'Proposal Whatsapp & Sms Sent to client','message_type'=>1]);
            // LeadMessages::create(['leadid'=>$userid,'message'=>'Warm Whatsapp Sent','message_type'=>2]);
            break;
        case 4:
if ($lang) {
$message="प्रिय *{$username}*,
हमारे सलाहकार से  बात करने व हमारे मुफ्त demo session में रुचि रखने के लिये धन्यवाद।
आपके चयनित दिन और समय पर आपका demo session हमारे एक काबिल प्रशिक्षक के द्वारा लिया जाएगा।
अधिक जानकारी के लिए आप हमारे सलाहकार को फोन करें या फिर हमारी website पर जायें।
*एक दिन का क्लास बिलकुल मुफ्त है।*
नोट:– demo session में जुड़ने के लिए आपके पास इंटरनेट वाले स्मार्टफोन या फिर लैपटॉप/कंप्यूटर की जरूरत पड़ेगी।
धन्यवाद,
*{$trainername}*
*{$trainernumber}*
Counsellor
ORAD CONSULTANCY";
} else {
$message="Dear *{$username}*,
Thank you for having an interaction with our counsellor *{$username}*, and for requesting a free demo session.
Soon you will receive confirmation of your free live 1:1 class with our experienced and professional trainer on the date and time of your choice.
For more information or any doubt please contact our counsellor or visit our website.
Our one day live 1:1 training session is absolutely FREE!!!
Note:- A laptop/computer or a smartphone/tablet with stable internet connection is required to attend the demo session.
Thank you,
*{$trainername}*
*{$trainernumber}*
Counsellor
ORAD CONSULTANCY";
}   
        self::sendmessagealternate($message,$mobile);
        SmsService::clienthotcall($trainername,$trainernumber,$mobile,$username);
        LeadMessages::create(['leadid'=>$userid,'message'=>'Demo Confirmation whatsapp & Sms Sent to client','message_type'=>1]);
        // LeadMessages::create(['leadid'=>$userid,'message'=>'Hot Whatsapp Sent','message_type'=>2]);
            break;
        default:
            # code...
            break;
    }
}


public static function trainerassign($userid,$date,$time,$trainerid){
    $user=User::findorFail($userid);
    $lang=$user->lang;
    $username=$user->name;
    $mobile=$user->mobile;
    $demolink=url('/').'/login';
    $trainer=User::find($trainerid);
    $trainername=$trainer->name;
    $trainernumber=$trainer->mobile;
if ($lang) {
$message="प्रिय *{$username}*,
आपकी इच्छानुसार आपका मुफ्त demo session तारीख *{$date}* को *{$time}* बजे निर्धारित हुआ है जो हमारे  उच्च शिक्षाप्राप्त प्रशिक्षक *{$trainername}* द्वारा लिया जायेगा।
आप अपने ORAD अकाउंट से दी गई लिंक से जुड़ सकते हैं {$demolink} 
आप को जल्द ही demo sessions से जुड़ने की लिंक भी दी जाएगी।
*एक दिन का क्लास बिलकुल मुफ्त है।*
नोट:– मुफ्त demo session में जुड़ने के लिए आप के पास  इंटरनेट वाला स्मार्टफोन या लैपटॉप/कंप्यूटर होना आवश्यक हैं।
धन्यवाद,
*{$trainername}*
*{$trainernumber}*
Counsellor
ORAD CONSULTANCY";
}else{
$message="Dear *{$username}*,
As per your request we have booked a free demo session for you on *{$date}* at *{$time}* with one of  our most experienced and highly educated trainer *{$trainername}*.
You can connect to your ORAD account using Log in link {$demolink}
You will soon receive a link to connect in the session.
*Our one day live 1:1 training session is absolutely free.*
Note: -A laptop/computer or a smartphone/tablet with stable internet connection is required to attend the demo session.
Thank you,
*{$trainername}*
*{$trainernumber}*
Counsellor
ORAD CONSULTANCY";
}
self::sendmessagealternate($message,$mobile);

}

public static function afterdemofeedback($userid,$trainername,$trainernumber){
    try {
        //code...
    
    $user=User::findorFail($userid);
    $username=$user->name;
    $lang=$user->lang;
    $mobile=$user->whatsappnumber ?$user->whatsappnumber : $user->mobile;
    $link=url('/').'/login';
    if ($lang) {
$message="\"प्रिय *{$username}*,
आपने हमारे  प्रशिक्षक के  साथ अपना 1:1 Demo session पूर्ण किया है  जिसका  प्रमाण पत्र आप अपने ORAD अकाउंट से Download कर सकते हैं, log in link {$link}
कृपया Demo session से जुड़े अपने विचार हमारे साथ साझा करने के लिये  feedback form भी भरे।
अधिक जानकारी के लिए हमारी website पर जाएं या हमारे सलाहकार *{$trainername}* को संपर्क करें।
धन्यवाद,
*{$trainername}*
*{$trainernumber}*
ORAD CONSULTANCY";
self::sendmessageUrlencode($message,$mobile);
    } else {
$message="Dear *{$username}*
You have successfully completed your live 1:1 demo class with *{$trainername}*. For downloading its certificate  please log in to your ORAD Account using Login link {$link}
Please fill the feedback form also.
For more details about the courses please contact our counselor or visit our website.
Regards,
{$trainername}
{$trainernumber}
ORAD Consultancy";
self::sendmessageUrlencode($message,$mobile);

    }
} catch (\Throwable $th) {
    //throw $th;
} 
}

public static function sendpaymentinfo($userid,$id){
    $user=User::findorFail($userid);
    $lang=$user->lang;
    $mobile=$user->mobile;
    $username=$user->name;
    $link=url('/').'/login';
    $paymentlink=route('billing',['id'=>encrypt($id)]);
    if ($lang) {
$message=
"प्रिय *{$username}*,
ORAD से जुड़ने के लिए धन्यवाद, हमें आपके द्वारा किए गए भुगतान की धनराशि प्राप्त हो गई है।
आपके द्वारा चयनित  दिन और समय से आपके क्लासेस शुरू कर दिए जाएंगे।
अधिक जानकारी या समस्या निवारण के लिए संपर्क करें।
नोट:– आप अपने भुगतान की रसीद इस लिंक से डाउनलोड कर सकते हैं।
{$link}
धन्यवाद,
ORAD CONSULTANCY";
self::sendmessagealternate($message,$mobile);
    } else {
$message=
"Dear *{$username}*,
Thank you for being our valued customer. We have received your payment. 
Please login to your ORAD account using the link to start your  learning journey with ORAD.
{$link}
Your classes  will start from your desired date and time.
Note:-  You can download the payment receipt from this link.
{$paymentlink}
For any queries or details please contact us.
REGARDS,
ORAD CONSULTANCY";
self::sendmessagealternate($message,$mobile);
    }
}

public static function rescheduledemo($userid,$date,$time){
    $user=User::find($userid);
    $username=$user->name;
    $lang=$user->lang;
    $mobile=$mobile=$user->whatsappnumber ? $user->whatsappnumber : $user->mobile;
    $link=url('/').'/login';
    if ($lang) {
$message="प्रिय *{$username}*,
आपकी मुफ्त demo session के समय में बदलाव के निवेदन के अनुसार, आप का मुफ्त demo session अब *{$date}* को *{$time}* बजे निर्धारित हुआ है।
आप अपने ORAD अकाउंट से नीचे दी गई लिंक से जुड़ सकते हैं 
 {$link} 
आप को जल्द ही demo sessions से जुड़ने के लिए भी लिंक दी जाएगी।
एक दिन का क्लास बिलकुल मुफ्त है।
नोट:– मुफ्त demo session में जुड़ने के लिए आप के पास  इंटरनेट वाला स्मार्टफोन या लैपटॉप/कंप्यूटर होना आवश्यक हैं।
धन्यवाद,
ORAD CONSULTANCY";
    } else {
$message="Dear *{$username}*,
Your free demo session has been rescheduled as per your request. Your next free demo session is on *{$date}* at *{$time}*.
You can connect to your ORAD account using Log in link {$link}
You will soon receive a link to connect in the session.
*Our one day live 1:1 training session is absolutely FREE!!!*
Note:- you must have a stable internet enabled Laptop/PC or Smartphone to attend this demo session.
Thank you,
ORAD CONSULTANCY";
    }
    
self::sendmessagealternate($message,$mobile);




}

/**
 * send scholarship result notification to scholarship user
 * 
 * @param userid
 * @return response
 */
public function scholarshipresult($userid)
{
    $user = User::findorFail($userid);
    $name = ucwords($user->name) ;
    $mobile = $user->mobile;
    $url=route('login');
$message="Dear {$name},

Greetings from ORAD! 
Hope you are doing good.

Hearty congratulations for successful completion of the ORAD Little Champ Competition. Wish you had a wonderful time in exploring your knowledge during the competition. 

To know your results and download the certificate, please login ORAD account here;
{$url}



Our best wishes to those students who have topped the competition. 
As promised, certificates for all the students and prizes for best performers will be awarded.

Regards 
Team ORAD

registered template for student  regarding Orad Scholarship Result announcement. ";
self::sendmessagealternate($message,$mobile);
}


}



