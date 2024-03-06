<?php

namespace App\Http\Livewire\Website;

use App\Models\Courses;
use Livewire\Component;
use App\Models\CoursesType;
use App\Models\CoursePayments;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\PaymentCourseTrait;

class Payment extends Component
{
    use PaymentCourseTrait;
    
    // render variables 
    public $courses=[], $parentCourse=[];
    public $parentCourseId, $childCourseId, $price, $duration;

    // payment variables 
    public $payment_id, $name, $email, $mobile, $parentCourseName, $childCourseName,$mrp;

    public function mount($courseid)
    {
        $decryptedData = decrypt($courseid);
        $this->parentCourseId = $decryptedData['parent_id'];
        $this->childCourseId = $decryptedData['course'];
        $this->payment_id = $decryptedData['payment_id'];

        if ($this->payment_id) {
            $paymentDetails = CoursePayments::findorFail($this->payment_id);
            $this->name = $paymentDetails->student->name ?? '';
            $this->email = $paymentDetails->email;
            $this->mobile = $paymentDetails->mobile;
            $this->parentCourseName = $paymentDetails->course->Course->name ?? '';
            $this->childCourseName = $paymentDetails->course->name ?? '';
            $this->duration = $paymentDetails->course->class_duration ?? '';
            $this->mrp = $paymentDetails->price;
            $this->price = $paymentDetails->discounted_price;
        }
        $this->parentCourse = Courses::where(['isactive'=>'1'])->get();
        $this->courses = CoursesType::where(['isactive'=>'1', 'course_id'=>$this->parentCourseId])->get();
    }
    
    public function render()
    {
        return view('website.payment')->layout('website.layouts.app');
    }
}
