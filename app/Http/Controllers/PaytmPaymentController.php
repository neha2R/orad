<?php

namespace App\Http\Controllers;

use PaytmWallet;
use Carbon\Carbon;
use App\Models\User;
use App\Models\LeadStatus;
use App\Models\CoursesType;
use Illuminate\Support\Str;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Models\CoursePayments;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Services\InappNotificationService;

class PaytmPaymentController extends Controller
{
    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function paytmPayment(Request $request)
    {
        
        if (!$request->has('cousePaymentId')) {
            $request->validate([
                'name'      => 'required|regex:/^[\pL\s\-]+$/u|string|min:3|max:50',
                'email'     => 'required|email|string|max:255',
                'mobile'    => 'required|numeric|digits_between:10,13',
                'course'    => 'required',
                'course_type'  => 'required',
            ]);

            $courseDetails = CoursesType::find($request->course_type);
            if ($courseDetails == null) {
                return redirect()->route('payment')->with('error','Invalid Course...');
            }
    
            // check user is already exists or not in user table 
            $user = User::where('email',$request->email)->orWhere('mobile',$request->mobile)->first();
    
            if ($user == null) {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->mobilecode = '+91';
                $user->mobile = $request->mobile;
                $user->department = '0';
                $user->role = '0';
                $user->password = Hash::make($request->mobile);
                $user->user_type = '2';
                if(!$user->save()){
                   return redirect()->route('payment')->with('error','Something went wrong...'); 
                }
            }

            // Payment prepare variables 
            $userid = $user->id;
            $price = $courseDetails->discounted_price != 0 ? $courseDetails->discounted_price : $courseDetails->price;
        }else {
            $paymentdetails = CoursePayments::findorFail($request->cousePaymentId);

            $userid = $paymentdetails->customer_id; 
            $price = $paymentdetails->discounted_price; 
        }
        
        
        // $price = '1';
        $payment = PaytmWallet::with('receive');
        $orderid = "ORDERID_".Carbon::now()->timestamp;
        $payment->prepare([
          'order' => $orderid,
          'user' => $userid,
          'mobile_number' => $request->mobile,
          'email' => $request->email,
          'amount' => $price,
          'callback_url' => route('paytm.callback'),
        ]);
        
        if (!$request->has('cousePaymentId')) {
            $linkid = Str::random(8);
            if (CoursePayments::where('linkid', $linkid)->exists()) {
                $linkid = Str::random(8) . Str::random(2);
            }

            $data = ['customer_id' => $user->id, 'email' => $request->email, 'mobile' => $request->mobile, 'price' => $price, 'discounted_price' => $courseDetails->discounted_price, 'linkId' => $linkid, 'order_id'=> $orderid,'course_parent_id'=>$courseDetails->course_id, 'course_id' => $courseDetails->id, 'survey'=>'0'];
            
            $coursepayment = CoursePayments::create($data);
            $paymentid = $coursepayment->id;
        }else {
            $coursepayment = CoursePayments::findorFail($request->cousePaymentId);
            $paymentid = $coursepayment->id;
            $coursepayment->update(['order_id'=> $orderid,'survey'=>'1']);
        }

        // create new lead transer record for bdm tl 
        $this->assignLead($paymentid);


        WhatsappService::optin($request->mobile);
        WhatsappService::sendpaymentinfo($coursepayment->customer_id,$orderid);
        SmsService::paymentinfo($coursepayment->customer_id,$orderid);
        InappNotificationService::paymentdone($orderid);
        return $payment->receive();
    }


    /**
     * Obtain the payment information.
     *
     * @return Object
     */
    public function paytmCallback()
    {
        $transaction = PaytmWallet::with('receive');
        
        $response = $transaction->response(); // To get raw response as array
        //Check out response parameters sent by paytm here -> http://paywithpaytm.com/developer/paytm_api_doc?target=interpreting-response-sent-by-paytm
     
        $success = $transaction->isSuccessful() ? '1' : '0';
        $json_response = json_encode($response);
        
        $courseData = CoursePayments::where('order_id',$response['ORDERID']);
        $courseData->update(['paytm_response_raw'=>$json_response,'payment_success'=>$success]);
        
        $result = $transaction->isSuccessful() ? 'success' : 'error';
        return redirect()->route('student.dashboard')->with($result,$response['RESPMSG']);

        $transaction->getResponseMessage(); //Get Response Message If Available
        //get important parameters via public methods
        $transaction->getOrderId(); // Get order id
        $transaction->getTransactionId(); // Get transaction id
    }

    /**
     * 
     * =====================================================================================
     * Before transfer the lead to QA first we update the status in BDM & BDE Junior panel.
     * so that we identify that Lead's payment done and convert into regular student
     * ===================================================================================
     * 
     * First, we will check lead's payment is done or not after that we update payment status in course_payment table
     * Second, we will updat lead status in Demo Manager & Demo Trainer panel
     * Third, we will update lead status in BDM & BDE Junior panel
     * Then last we will transfer lead to QA
     *
     *  @param $payment id(paymentcourse table id)
     */
    public function assignLead($paymentid)
    {
        $coursePayments = CoursePayments::findorFail($paymentid);
        if ($coursePayments->user_id != null) {
            $trainerStatus = LeadStatus::findorFail($coursePayments->lead_id);
            
            $assignedbyManager = $trainerStatus->assignedby;
            $leadid = $trainerStatus->leadid;
            
            // update lead status in demo trainer panel 
            $trainerStatus->update(['is_paid'=>'1']);

            $demoManagerStatus = LeadStatus::where([ 'assignedto'=>$assignedbyManager, 'leadid'=> $leadid ])->latest()->first();
            
            if ($demoManagerStatus) {
                
                // update lead status in demo manager panel 
                $trainerStatus ->update(['is_paid'=>'1']);

                // update status BDE TL & BDE Intern
                $bdePanel = LeadStatus::where(['leadid'=> $leadid, 'department'=>'3', 'sub_department'=>'2' ])->get();
                
                foreach ($bdePanel as $key => $value) {
                    $value->update(['is_paid'=>'1']);
                }
            }

        }

        $assignDate=  date('Y-m-d');

        // get all QA manager 
        $manager=User::where(['department'=>'4','sub_department'=>'4','role'=>'2','user_type'=>'1'])->pluck('id')->toArray();

        $assignedto=0; 

        // get last created lead 
        $lastassignment=LeadStatus::where(['department'=>'4','sub_department'=>'4','level'=>'7'])->latest()->first();

        if ($lastassignment) {

            $lastleadassignedto=LeadStatus::where(['department'=>'4','sub_department'=>'4','level'=>'7'])->latest()->first()->assignedto;
            $key = array_search($lastleadassignedto, $manager);
            $lastindex=count($manager)-1;

            // if senior sale is last from rows then assign to first senior sales
            if ($lastindex == $key) {
                $assignedto=$manager[0];
            }else{
                $assignedto=$manager[$key+1];
            }
            
        }else{
            
            // if last created lead is null then assign lead to first senior sales 
            $sesiorsales=User::where(['department'=>'4','sub_department'=>'4','role'=>'2'])->first();
            if ($sesiorsales) {
                $assignedto=$sesiorsales->id;
            }
        }

        // lead transfer to QA 
        LeadStatus::create(['leadid'=>$coursePayments->customer_id,'assignedby'=>'0','assignedto'=>$assignedto, 'assign_date'=>$assignDate, 'level'=>'7','leadtype'=>'4','department'=>'4', 'sub_department'=>'4','comments'=>'Lead transfer from BDE Junior to QA', 'is_paid'=>'1']);
        leadHistoryMessageSeniorMarketingAssignment($coursePayments->mobile, $assignedto, $coursePayments->customer_id);

    }

    /**
     * Get bill details 
     * 
     * @param course payment id
     * @return response
     */

    public function billing($id){
      $id=decrypt($id);
      $data=CoursePayments::findorFail($id);
      return view('billing',compact('data'));
    }

    /**
     * Short url of payment link
     * 
     * @param $linkid
     */
    public function shorturl($link){
        $data =  CoursePayments::where(['linkId'=>$link,'is_expired'=>0])->first();
        $course = CoursesType::where('isactive', '1')->whereNotNull('course_id')->first();
        $paymentid = $data ? $data->id : null;
        $parentid = $course ? $course->course_id : null;
        $courseid = $course ? $course->id : null;
        return redirect()->route('payment',encrypt(['parent_id'=>$parentid,'course'=>$courseid, 'payment_id'=>$paymentid]));
    }

}