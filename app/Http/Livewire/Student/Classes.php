<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use App\Models\Classes as ModelClass;
use App\Models\ClassFeedback;
use App\Models\Classes as ModelClasses;
use App\Models\Slot;
use App\Models\ContentCategory;
use App\Models\OradContent;
use App\Models\User;
use App\Models\ContentComplaint;

class Classes extends Component
{       
    public $currentdemofeedbackid,$currentfeedback,$classidforfeedback,$currentfeedbacktype;

    public $currentrescheduleid,  $date,$slot;
    public  $currentcomplaintid,$complaintinfo;
    public function mount(){
        
    }

    public function classreschdule($id){
        $classdetails=ModelClasses::findorFail($id);
        $this->currentrescheduleid=$id;
        $this->date=$classdetails->date;
        $this->slot=$classdetails->slot;
    }

    public function resetInputs(){
        $this->currentdemofeedbackid='';
        $this->currentfeedback='';
        $this->classidforfeedback='';
        $this->currentfeedbacktype='';
        $this->currentrescheduleid='';
        $this->date='';
        $this->slot='';
    }

    public function recordfeedback($classid,$feedbacktype){
        $this->classidforfeedback=$classid;
        $this->currentfeedbacktype=$feedbacktype;
    }

    public function rescheduleStore(){
        // dd($this->date,$this->slot);
        ModelClasses::findorFail($this->currentrescheduleid)->update(['class_date'=>$this->date,'slot'=>$this->slot]);
        $this->resetInputs();
        $this->emit('modalcallback',1);
    }

    public function registercomplaint($contentid){
        $this->currentcomplaintid=$contentid;
    }

    public function storecontaintcomplain(){
        $contentmanager=User::where(['department'=>5,'role'=>2])->first();
        ContentComplaint::create(['content_id'=>$this->currentcomplaintid,'complaint_creator'=>auth()->user()->id,'assigned_to'=>$contentmanager->id,'content_details'=>$this->complaintinfo]);
        $this->resetInputs();
        $this->emit('modalcallback',1);
    }

    public function store(){
        $classdetails=ModelClasses::findorFail($this->classidforfeedback);
        ClassFeedback::create(['class_id'=>$this->classidforfeedback,'feedback_type'=>$this->currentfeedbacktype,
        'feedback_from'=>auth()->user()->id,'feedback_to'=>$classdetails->trainerid,'feedback'=>$this->currentfeedback]);
        $this->resetInputs();
        $this->emit('modalcallback',1);
    }

    public function render()
    {
        $data=ModelClass::where('leadid',auth()->user()->id)->get();
        $slots=Slot::all();
        $content=ContentCategory::all();
        $todaycontent=ModelClass::where('class_date',today())->first();
        if ($todaycontent) {
            $todaycontent=OradContent::where('proofreadsenior',1)->where('keyword',$todaycontent->content_id)->get();

        }else{
            $todaycontent=[];
        }
        
        // $todaycontent=OradContent::where('proofreadsenior',1)->where('keyword',$todaycontent->content_id)->get();
        return view('livewire.school.classes',compact('data','slots','content','todaycontent'));
    }
}
