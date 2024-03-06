<?php

namespace App\Http\Traits;

use App\Models\User;
use Carbon\CarbonPeriod;
use App\Models\LeadStatus;
use App\Models\ProvideSlot;
use App\Models\TrainerSlots;
use App\Models\CoursePayments;
use App\Models\Classes as ScheduledClasses;

/**
 * Lead assignment and reschedule process 
 * QA assign lead to Class trainer
 * 
 */
trait AssignClassByQA
{
    // assignement variables 
    public $leadid,$startDate,$endDate,$assignto,$slot,$join_link, $errormessage;

    // trainers available slots 
    public $availableSlots=[];
    

    public function updatedStartDate(){
        if ($this->endDate) {
            $this->checkAvailablity();
            $this->errormessage = $this->startDate > $this->endDate ? 'Please select valid interval' : '';
        }
    }

    public function updatedEndDate(){
        if ($this->startDate) {
            $this->checkAvailablity();
            $this->errormessage = $this->startDate > $this->endDate ? 'Please select valid interval' : '';
        }
    }


    /**
     * get only available slots
     * 
     */
    public function updatedAssignto(){
        $this->checkAvailablity();
    }

    // check trainer time slot availablity 
    public function checkAvailablity(){
        $alreadyExistsSlots = ScheduledClasses::where('trainerid',$this->assignto)->whereBetween('class_date', [$this->startDate, $this->endDate])->distinct('slot')->get()->pluck('slot')->toArray();
        $this->availableSlots = ProvideSlot::where('trainer_id',$this->assignto)->whereNotIn('slot_id',$alreadyExistsSlots)->distinct('slot')->get()->pluck('slot_id')->toArray();
    }

    public function resetAssignment(){
        $this->startDate = '';
        $this->endDate = '';
        $this->assignto = '';
        $this->slot = '';
        $this->errormessage = '';
    }

    /**
     * User assignement part
     */
    public function assignLead(){
        // $url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        
        $validatedData = $this->validate(
            [
                'leadid' =>'required',
                'startDate' =>'required| date',
                'endDate' =>'sometimes|date|after:startDate',
                'assignto' =>'required',
                'slot' =>'required',
                // 'join_link' =>'required|regex:'.$url,
            ],
            [
                'assignto.required' => 'Please select any trainer',
                'leadid.required' => 'Select leads',
                'endDate.different' => 'Start Date must be different from To End Date',
                'leadEndTo.different' => 'To Column must be different from From Column',
            ]
        );

        
        $leadStatus = LeadStatus::findorFail($this->leadid);
        $leadid = $leadStatus->leadid;
        $assignDate = date('Y-m-d',strtotime($this->startDate));
        
        // lead update in QA
        $leadStatus->update(['is_transferred' => '1']);
        
        
        $paymentDetails = CoursePayments::where(['customer_id'=>$leadid, 'payment_success'=>'1'])->latest()->first();
        $coursepaymentid = $paymentDetails->coursepaymentid ?? null;
        $course_id = $paymentDetails->course_id ?? null;
        if ($this->endDate == null) {
           
            // create trainer slots 
            $trainerSlotAlreadyExists = TrainerSlots::where(['date'=>$assignDate, 'trainer_id'=>$this->assignto, 'slot_id'=> $this->slot])->exists();
            if (!$trainerSlotAlreadyExists) {
                TrainerSlots::create(['date'=>$assignDate ,'manager_id'=>auth()->user()->id, 'trainer_id'=>$this->assignto, 'slot_id'=> $this->slot, 'lead_id'=>$leadid, 'type'=>'1','available_seats'=>'1']);                
            }

            // create class schedule 
            $scheduleAlreadyExists = ScheduledClasses::where(['class_date'=>$assignDate, 'trainerid'=>$this->assignto, 'slot'=> $this->slot])->exists();

            if (!$scheduleAlreadyExists) {
                ScheduledClasses::create(['leadid'=>$leadid, 'trainerid'=>$this->assignto, 'class_date'=>$assignDate, 'slot'=>$this->slot, 'seniortrainer_id'=>auth()->user()->id, 'coursepaymentid'=>$coursepaymentid, 'course_id'=>$course_id]);
            }

        }else {
            $interval = CarbonPeriod::create($this->startDate,$this->endDate)->toArray();
           
            foreach ($interval as $key => $value) {
               $date = date('Y-m-d',strtotime($value));

                // create trainer slots 
                $trainerSlotAlreadyExists = TrainerSlots::where(['date'=>$assignDate, 'trainer_id'=>$this->assignto, 'slot_id'=> $this->slot])->exists();
                if (!$trainerSlotAlreadyExists) {
                    TrainerSlots::create(['date'=>$date ,'manager_id'=>auth()->user()->id, 'trainer_id'=>$this->assignto, 'slot_id'=> $this->slot, 'lead_id'=>$leadid, 'type'=>'1','available_seats'=>'1']);
                }


                // create class schedule 
                $scheduleAlreadyExists = ScheduledClasses::where(['class_date'=>$date, 'trainerid'=>$this->assignto, 'slot'=> $this->slot])->exists();
                if (!$scheduleAlreadyExists) {
                    ScheduledClasses::create(['leadid'=>$leadid, 'trainerid'=>$this->assignto, 'class_date'=>$date, 'slot'=>$this->slot,  'seniortrainer_id'=>auth()->user()->id, 'coursepaymentid'=>$coursepaymentid, 'course_id'=>$course_id]);
                }
            }
        }
        
        // check if lead is already transferred 
        $alreadyTransferred = LeadStatus::where(['leadid'=>$leadid, 'assignedby'=>auth()->user()->id, 'assignedto'=>$this->assignto])->exists();

        // lead transfer to class trainer
        if (!$alreadyTransferred) {
            LeadStatus::create(['leadid'=>$leadid, 'assignedby'=>auth()->user()->id, 'assignedto'=>$this->assignto, 'assign_date'=>$assignDate,'level'=>'8', 'leadtype'=>'4','department'=>'4', 'sub_department'=>'4','comments'=>'Lead transfer from Demo Trainer to Class Trainer', 'is_paid'=>'1']);
        }

        // assign user's slot & trainer id in user table 
        $leadDetails=User::findorFail($leadid);
        $clientname = $leadDetails->name;
        $leadDetails->update(['parent_id'=>$this->assignto, 'slot_id'=> $this->slot]);
         
        $message="Please Assign a trainer to ".$clientname."";
        leadTransfer($leadDetails->mobile,$this->assignto,$leadDetails->id, 'Lead Transferred');
        // leadHistoryJuniorMarketingAssignment(auth()->user()->id,$this->assignto,$leadid);
        // InappNotificationService::srmarketingassignleadtojrmarketing($this->assignto,count($leadid),auth()->user()->name);
        $this->statsRefresh();
        $this->resetAssignment();
        $this->emit('flashmessage', 'Assigned successfully');
    }

}
