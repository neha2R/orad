<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use App\Models\Demo;
use App\Models\User;
use App\Models\FeedBack;
use App\Models\LeadStatus;
use App\Models\CoursesType;
use Illuminate\Support\Str;
use App\Models\CoursePayments;
use App\Models\DiscountManagment;
use App\Services\WhatsappService;

/**
 * Feedback of specific trait
 * 
 * This triat only work in live wire 
 */
trait PaymentLinkTrait
{
    // payment link variables 
    public $courses=[], $paymentHistory=[], $unconvertedLead=[];

        
    // leadid, mobile, email, courseid, discount
    public $course, $mrp, $price, $discount, $discountedPrice=0;



    // after select course update price 
    public function updatedCourse(){
        if ($this->course) {
            $this->mrp = CoursesType::findorFail($this->course)->price;
            $this->price = CoursesType::findorFail($this->course)->discounted_price;
            $this->discountedPrice = 0;
        }
    }


    public function addDiscount(){
        $discount = DiscountManagment::where(['department'=>'3', 'sub_department'=>'1','role'=>'2'])->latest()->first();
        if ($discount != null && $this->discountedPrice == 0) {
            $discountPrice = (float)(($discount->amount * $this->mrp) / 100);
            $this->discountedPrice = $this->mrp - $discountPrice;
            $this->price = $this->discountedPrice;
            
        }
    }

    // get lead payment history after update or lead id 
    public function updatedLeadId(){
        if ($this->leadid) {
            $this->paymentHistory = CoursePayments::where('customer_id',$this->leadid)->get();
            $this->mobile = User::findorFail($this->leadid)->mobile;
            $this->email = User::findorFail($this->leadid)->email;
        }
    }

    // send whatsapp link
    public function sendwhatsapplink()
    {
        $userid = auth()->user()->id;
        $leadstatus = LeadStatus::where(['assignedto' => auth()->user()->id,'is_paid' => '0', 'leadid'=>$this->leadid])->first();
        $leadDetails = User::findorFail($this->leadid);
        $leadid=$leadstatus->id;
        $linkid = Str::random(8);
        if (CoursePayments::where('linkid', $linkid)->exists()) {
            $linkid = Str::random(8) . Str::random(2);
        }
        
        $alreadyExists = CoursePayments::where(['lead_id' => $leadid,'is_expired'=>'0'])->latest()->first();
        
        if ($alreadyExists) {
            $linkid= $alreadyExists->linkId;
            
            $alreadyExists->update(['is_expired'=>'1']);
        }
        $data = ['lead_id' => $leadid, 'customer_id'=> $this->leadid,'user_id' => $userid, 'email' => $leadDetails->email, 'mobile' => $leadDetails->whatsappnumber, 'price' => $this->mrp, 'discounted_price' => $this->price, 'linkId' => $linkid, 'lead_status' => $leadstatus->id, 'course_id' => $this->course];
        CoursePayments::create($data);
        
        WhatsappService::sendpaymentlink($this->leadid,$this->course,$this->price,$linkid,auth()->user()->name,auth()->user()->mobile);

        $this->resetInputsLead();
        $this->emit('flashmessage', 'Payment Link Sent Successfully');
    }

    public function resetInput(){
        $this->editId = '';
        $this->paymentHistory=[];
        $this->leadid='';
        $this->course='';
        $this->mrp = '';
        $this->price = '';
        $this->discount = '';
        $this->discountedPrice=0;
    }
}
