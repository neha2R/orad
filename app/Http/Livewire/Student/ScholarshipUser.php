<?php

namespace App\Http\Livewire\Student;

use App\Models\Demo;
use App\Models\Exam;
use Livewire\Component;
use App\Models\FeedBack;
use App\Models\ExamResult;
use App\Models\ExamInstruction;
use Illuminate\Support\Facades\Crypt;

class ScholarshipUser extends Component
{
    public $instruction_id;
    public $class_group=12;

    public function mount()
    {
        $student_class = auth()->user()->parent->class ?? '12';
        $current_date = date('Y-m-d');
        $instruction = ExamInstruction::where('class_name',$student_class)->where('is_active','1')->where('start_date','<=',$current_date)->where('end_date','>=',$current_date)->first();

        // check if user already submitted the current examination 
        if ($instruction) {
            $alreadyExamSubmitted = ExamResult::where('user_id',auth()->user()->id)->where('exam_id',$instruction->id)->exists();
        }else {
            $alreadyExamSubmitted = false;
        }
        $this->instruction_id = $instruction && !$alreadyExamSubmitted ? $instruction->id : 0;
    }
    public function submit($id){
        $demo=Demo::findorFail($id);
        FeedBack::create(['demoid'=>$id,'rating'=>$this->rating,'comment'=>$this->comment,'feedback_from'=>auth()->user()->id,'feedback_to'=>$demo->id,'leadstatus'=>$demo->leadstatus]);
        $demo->update(['student_feedback'=>1,'certificate'=>1]);
        $this->comment="";
        $this->rating="";
    }

    public function render()
    {
        $id=auth()->user()->id;
        $demos=Demo::where('leadid',$id)->orderBy('id','desc')->get();
        return view('livewire.school.scholarship',['demos'=>$demos,'is_exam_started'=>$this->instruction_id])->layout('layouts.new-app');
    }
}
