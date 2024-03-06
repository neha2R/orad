<?php

namespace App\Http\Traits;

use App\Models\Classes;
use App\Models\ClassFeedback;

/**
 * Class Feedback of specific user
 * 
 * This triat only work in live wire 
 */
trait ClassFeedbackTrait
{

    // store class feedback variables 
    public $feedbackid, $feedback, $studentid, $classid, $studentname, $feedbackTrainerid, $rating=0;

    public function resetFeedbackInput(){
        $this->feedbackid = '';
        $this->feedback = '';
        $this->studentname  = '';
        $this->feedbackTrainerid  = '';
        $this->classid  = '';
        $this->rating  = '';
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
        $this->rating = $scheduledClass->feedbackRelation != null ? $scheduledClass->feedbackRelation->feedback_type?? 0 : 0;
        $this->classid = $classid ?? '';
        $this->feedback = $scheduledClass->feedbackRelation->feedback ?? $this->feedback;
        $this->studentname = ucwords($scheduledClass->studentRelation->name ?? '');
        $this->feedbackTrainerid = $scheduledClass->trainerid ?? '';
        
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
     * Store feedback of student
     */
    public function storeFeedback(){
        $validatedData =  $this->validate([
            'feedback' => 'required',
            'rating' => 'required',
        ]);
        $feedbackData = ['feedback_type'=>"$this->rating", 'feedback'=>$this->feedback, 'feedback_from'=>auth()->user()->id, 'feedback_to'=>$this->feedbackTrainerid, 'class_id'=>$this->classid];
        
        $feedback = ClassFeedback::where($feedbackData)->first();

        if ($feedback) {
            $feedback->update($feedbackData);
        }
        $feedback = ClassFeedback::create($feedbackData);
        $scheduledClass = Classes::find($this->classid);
        if ($scheduledClass) {
            $scheduledClass->update(['class_feedback_id'=>$feedback->id,'student_attend'=>'1','trainer_attend'=>'1']);
        }
        $this->resetFeedbackInput();
        $this->emit('flashmessage', 'Thank you for the feedback');
    }

}