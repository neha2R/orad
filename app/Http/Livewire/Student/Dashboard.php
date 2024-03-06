<?php

namespace App\Http\Livewire\Student;

use App\Models\Demo;
use App\Models\Slot;
use App\Models\User;
use App\Models\Courses;
use Livewire\Component;
use App\Models\LeadStatus;
use App\Models\CoursesType;
use App\Models\CoursePayments;

class Dashboard extends Component
{
    // render variables 
    public $activeState=0, $errormessage, $purchasedCourse;

    // schedule demo variables 
    public $demo_slots=[], $userDemo=[], $date, $slot;

    // feedback variables 
    public $rating=0;

    // courses variables 
    public $cousePaymentId, $courses=[], $studentId, $studentName, $email, $mobile, $parentCourseId, $parentCourseName, $childCourseId, $childCourseName, $price, $discount,  $duration, $discountOnCourse=[], $discountedLinks=[];

    public function stateRefresh(){
        // check lead status in demo table 
        $this->userDemo = Demo::where(['leadid'=>auth()->user()->id])->latest()->first();
        $hasPaymentDone = CoursePayments::where(['customer_id'=>auth()->user()->id,'payment_success'=>'1'])->exists();
        // dd($this->userDemo, auth()->user());
        if ($this->userDemo) {
            $this->rating = $this->userDemo->student_feedback ?? 0;
        }
        if (!$this->userDemo) {
            $this->activeState=0;
        }elseif (!$this->userDemo->trainerid || !$this->userDemo->is_demodone) {
            $this->activeState=1;
        }elseif ($this->userDemo->trainerid && $this->userDemo->is_demodone && !$hasPaymentDone) {
            $this->activeState=2;
        }else {
            $this->activeState=3;
        }
        
    }

    public function mount(){
        $this->studentId = auth()->user()->id;
        $this->studentName = ucwords(auth()->user()->name);
        $this->email = auth()->user()->email;
        $this->mobile = auth()->user()->mobile;
        $this->courses = CoursesType::where('isactive','1')->get();
        $this->demo_slots = Slot::where('is_active','1')->get();
        $discountedCourse = CoursePayments::where(['customer_id'=>auth()->user()->id, 'is_expired'=>'0'])->get();
        $this->discountOnCourse = $discountedCourse->pluck('discounted_price','course_id')->toArray();
        $this->discountedLinks = $discountedCourse->pluck('id','course_id')->toArray();
        $this->stateRefresh();
    }

    public function resetInputs(){
        $this->date='';
        $this->slot='';
        $this->errormessage='';
    }

    public function updatedDate(){
        $this->errormessage='';
    }

    public function scheduleDemo(){
        $validatedData = $this->validate([
            'slot' => 'required',
            'date' => 'required',
        ]);
        
        $assignDate=  date('Y-m-d',strtotime($this->date));
        if ($assignDate < date('Y-m-d')) {
            $this->errormessage = "Please select valid date";
        }

        if (!$this->errormessage) {
            // get all demo manager 
            $demomanager=User::where(['department'=>'4','sub_department'=>'3','role'=>'2','user_type'=>'1'])->pluck('id')->toArray();
            
            $assignedto=0;
    
            // get last created lead 
            $lastassignment=LeadStatus::latest()->first();
    
            if ($lastassignment) {
    
                $lastleadassignedto=LeadStatus::latest()->first()->assignedto;
                $key = array_search($lastleadassignedto, $demomanager);
                $lastindex=count($demomanager)-1;
    
                // if senior sale is last from rows then assign to first senior sales
                if ($lastindex == $key) {
                    $assignedto=$demomanager[0];
                }else{
                    $assignedto=$demomanager[$key+1];
                }
                
            }else{
                
                // if last created lead is null then assign lead to first senior sales 
                $sesiorsales=User::where(['department'=>"4",'sub_department'=>"3",'role'=>"2"])->first();
                if ($sesiorsales) {
                    $assignedto=$sesiorsales->id;
                }
            }
            
            LeadStatus::create(['leadid'=>auth()->user()->id,'assignedby'=>0,'assignedto'=>$assignedto, 'assign_date'=>$assignDate, 'level'=>'3','leadtype'=>'0','department'=>'3', 'sub_department'=>'2','comments'=>'Lead assigned by System to BDE TL']);
    
            // store Schedule demo in demo table 
            Demo::create(['leadid'=>auth()->user()->id, 'seniortrainer_id'=>$assignedto, 'date'=>$assignDate, 'slot'=>$this->slot]);
                
            leadTransfer(auth()->user()->mobile,$assignedto,auth()->user()->id);
            $this->resetInputs();
            $this->emit('flashmessage', 'Your demo preference has been saved, We will contact you shortly');
        }
    }


    /**
     * Change rating status 
     * 
     * @param rating numbers
     * @return response
     */
    public function ratingStatus($star){
        $this->rating = $star;
    }

    /**
     * submit feedback of specific demo
     * 
     * @param demoid
     * @param rating
     * @return response
     */
    public function submitFeedback(){
        $demoid = $this->userDemo->id;
        $this->userDemo->update(['student_feedback'=>"$this->rating"]);

        // trigger lead to BDM after demo done 
        assignLeadToBDM(auth()->user()->id, $demoid);
        $this->emit('flashmessage', 'Thank you for your feedback...');
        $this->stateRefresh();
    }

    public function resetCourse(){
        $this->parentCourseId = '';
        $this->parentCourseName = '';
        $this->childCourseId = '';
        $this->childCourseName = '';
        $this->price = '';
        $this->discount = '';
        $this->cousePaymentId = '';
        $this->stateRefresh();
    }

    /**
     * get specific course details
     * 
     * @param int courseid
     */
    public function courseDetails($courseid){
        $courseData = CoursesType::findorFail($courseid);
        $this->cousePaymentId = in_array($courseid, array_keys($this->discountedLinks)) ? $this->discountedLinks[$courseid] : null;
        $this->parentCourseId = $courseData->course_id;
        $this->parentCourseName = $courseData->Course->name ?? '';
        $this->childCourseId = $courseData->id;
        $this->childCourseName = $courseData->name;
        $this->price = in_array($courseid, array_keys($this->discountOnCourse)) ? $this->discountOnCourse[$courseid] : $courseData->price;
        $this->discount = $courseData->discount;
        $this->duration = $courseData->no_of_classes;
    }



    public function render()
    {
        $id=auth()->user()->id;
        
        $this->purchasedCourse=CoursesType::whereHas('purchasedCourse',function ($query)
        {
            return $query->where(['customer_id'=>auth()->user()->id, 'payment_success'=>'1']);
        })->latest()->first();
        
        $demos=Demo::where('leadid',$id)->orderBy('id','desc')->get();
        return view('livewire.student.dashboard',['demos'=>$demos])->layout('layouts.new-app');
    }
}
