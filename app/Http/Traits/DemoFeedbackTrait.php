<?php

namespace App\Http\Traits;

use App\Models\Demo;
use App\Models\FeedBack;
use App\Models\LeadStatus;

/**
 * Demo Feedback of specific trait
 * 
 * This triat only work in live wire 
 */
trait DemoFeedbackTrait
{
     
    // feedback variables 
    public $is_demodone, $comment, $behaviour, $parent_attend, $course_like, $call_date, $call_time, $leadStatusId, $demoid,$demoLeads=[], $video_link;

    /**
     * get previous date and time details of specific lead for demo reschedule
     * get lead feedback details from feedback table
     * 
     * 
     */
    public function updatedDemoid(){
        $demoData = Demo::findorFail($this->demoid);
        $this->demoDate= $demoData->date;
        $this->slot= $demoData->slot;

        $data = FeedBack::where(['demoid'=>$this->demoid, 'feedback_from'=>auth()->user()->id])->first();
        
        if ($data != null) {
            $this->leadStatusId = $data->id;
            $this->is_demodone = $data->demo_taken;
            $this->comment = $data->comment;
            $this->behaviour = $data->behaviour;
            $this->parent_attend = $data->parent_attend;
            $this->course_like = $data->course_like;
            $this->call_date = $data->call_date;
            $this->call_time = $data->call_time;
            $this->video_link = $data->video_link;
        }
    }


    public function resetFeedbackInput(){
        $this->editId = '';
        $this->is_demodone = '';
        $this->comment = '';
        $this->behaviour = '';
        $this->parent_attend = '';
        $this->course_like = '';
        $this->demoid = '';
        $this->call_date='';
        $this->call_time='';
        $this->errormessage='';
        $this->video_link='';
    }

    /**
     * Store feedback of demo trainer
     * 
     */

    public function storeFeedback(){
        $validatedData = $this->validate([
            'demoid'=>'required',
            'is_demodone'=>'required',
            'comment'=>'required',
            'behaviour'=>'required',
            'parent_attend'=>'required',
            'course_like'=>'required',
            'call_date'=>'required',
            'call_time'=>'required',
        ]);

        // find demo details 
        $demoData = Demo::findorFail($this->demoid);

        // create feedback of student 
        $feedbackData = ['leadstatus'=>$demoData->leadstatus,'demoid'=>$this->demoid,'feedback_from'=>auth()->user()->id, 'feedback_to'=>$demoData->leadid,'feedback_type'=>'1', 'comment'=>$this->comment, 'behaviour'=>$this->behaviour,'demo_taken'=>$this->is_demodone,'parent_attend'=>$this->parent_attend,'course_like'=>$this->course_like,'call_date'=>$this->call_date,'call_time'=>$this->call_time, 'video_link'=>$this->video_link];
        
        // check if feedback is already exists then update feedback other wise insert 
        $feedback = FeedBack::where(['leadstatus'=>$demoData->leadstatus,'demoid'=>$this->demoid,'feedback_from'=>auth()->user()->id])->first();
        
        if (!$feedback) {
            $feedback = FeedBack::create($feedbackData);
        }else {
            $feedback->update($feedbackData);
        }
        
        // update demo status & insert feedback id in demo table to track lead feedback 
        $demoData->update(['is_demodone'=>$this->is_demodone, 'feedback'=>$feedback->id]);

        // update demo status in bde panel 
        $BDELeadStatus = LeadStatus::where(['department'=>'3','sub_department'=>'2', 'leadid'=>$demoData->leadid])->get();
        if ($BDELeadStatus->isNotEmpty()) {
            foreach ($BDELeadStatus as $key => $value) {
                $value->update(['demoid'=>$this->demoid]);
            }
        }

        // update lead status from demo trainer account
        $trainerLeadStatus = LeadStatus::where(['assignedto'=>auth()->user()->id, 'leadid'=>$demoData->leadid])->first();
        if ($trainerLeadStatus) {
            $trainerLeadStatus->update(['demoid'=>$this->demoid]);
        }

        // transfer lead to bdm manager 
        assignLeadToBDM($demoData->leadid, $this->demoid);

        $this->resetFeedbackInput();
        $this->statsRefresh();
        $this->emit('flashmessage', 'Feedback store successfully');

    }

    /**
     * Get Feedback details 
     * 
     * @param $classid
     * @return response
     */
    public function showFeedback($classid=null){
        $scheduledClass = Classes::find($classid);
        $this->feedbackid = $scheduledClass->class_feedback_id ?? '';
        $this->rating = $scheduledClass->feedbackRelation != null ? $scheduledClass->feedbackRelation->feedback_type?? 1 : 1;
        $this->classid = $classid ?? '';
        $this->feedback = $scheduledClass->feedbackRelation->feedback ?? $this->feedback;
        $this->studentname = ucwords($scheduledClass->studentRelation->name ?? '');
        $this->feedbackTrainerid = $scheduledClass->trainerid ?? '';
        
    }

}
