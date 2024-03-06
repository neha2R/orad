<?php

namespace App\Http\Livewire\Training\QAManager;

use App\Models\User;
use App\Models\Classes;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\LeadStatus;
use Livewire\WithPagination;
use App\Models\ClassFeedback;
use App\Models\CoursePayments;
use App\Http\Traits\AssignClassByQA;
use App\Http\Traits\ClassFeedbackTrait;
use App\Models\StudentPerformance as Performance;

class StudentPerformance extends Component
{
    use WithPagination, ClassFeedbackTrait, AssignClassByQA;

    // render variables 
    public $students=[], $assesments=[], $assigntousers=[], $activeAssesment, $activeLead, $performance, $classfeedback, $errormessage, $userrole=2;

    // assessment variables 
    public $date, $topics, $lead_id, $leadid, $qa_id, $username;
    
    // parameter, feedback and marks variables 
    public $listening_marks, $listening_obtain, $reading_marks, $reading_obtain, $speaking_marks, $speaking_obtain, $writing_marks, $writing_obtain, $feedback;
    
    // result variables 
    public $avg_of_marks, $avg_of_obtain, $total;

    public $paginate=10, $search;

    public function statsRefresh(){
        $this->assigntousers = User::where('parent_id', auth()->user()->id)->orderBy('id','desc')->get();

        $this->activeLead = LeadStatus::has('scheduledClasses')->where(['assignedto'=>auth()->user()->id,'is_paid' => '1'])->select('leadid','id')->distinct('leadid')->first();
        $this->lead_id = $this->activeLead->leadid ?? '';
        $this->leadid = $this->activeLead->id ?? '';
    }

    public function resetInputs(){
        $this->date = '';
        $this->topics = '';

        $this->listening_marks = '';
        $this->listening_obtain = '';
        $this->reading_marks = '';
        $this->reading_obtain = '';
        $this->speaking_marks = '';
        $this->speaking_obtain = '';
        $this->writing_marks = '';
        $this->writing_obtain = '';
        $this->feedback = '';

        $this->avg_of_marks = '';
        $this->avg_of_obtain = '';
        $this->total = '';
    }
   
    public function mount(){
        // Classs trainerlists
        $this->statsRefresh();
        
    }

    public  function updatedDate(){
        $this->errormessage='';
    }


    /**
     * Store assessment of specific lead
     */
    public function storeAssesment(){
        $validatedData = $this->validate([
            'date' =>'required|date',
            'topics' =>'required',
            'lead_id' =>'required',

            'listening_marks' =>'required|string|max:100',
            'listening_obtain' =>'required|numeric|max:100',
            'reading_marks' =>'required|numeric|max:100',
            'reading_obtain' =>'required|string|max:100',
            'speaking_marks' =>'required|numeric|max:100',
            'speaking_obtain' =>'required|numeric|max:100',
            'writing_marks' =>'required|numeric|max:100',
            'writing_obtain' =>'required|numeric|max:100',
            'feedback' =>'required|string|max:100',
        ]);
        $alreadyExists = Performance::where(['date'=>$this->date, 'lead_id'=>$this->lead_id])->exists();
        if ($alreadyExists) {
            $this->errormessage = 'This assessment is already exists...';
        }

        $validatedData['qa_id'] =auth()->user()->id;
        $validatedData['avg_of_marks'] = ($this->listening_marks + $this->reading_marks + $this->speaking_marks + $this->writing_marks) / 4;
        $validatedData['avg_of_obtain'] = ($this->listening_obtain + $this->reading_obtain + $this->speaking_obtain + $this->writing_obtain) / 4;
        $validatedData['total']= ($validatedData['avg_of_obtain'] / $validatedData['avg_of_marks']) * 100;
        

        if ($this->errormessage == '') {
            Performance::create($validatedData);
            $this->resetInputs();
            $this->emit('flashmessage', 'Assessment create successfully');
        }

    }

    /**
     * show specific assesment details
     * 
     * @param int assesmentid
     * @return response
     */
    public function showAssesment($assesmentid){
        $data = Performance::find($assesmentid);
        $this->date = $data->date ?? '';
        $this->topics = $data->topics ?? '';

        $this->listening_marks = $data->listening_marks ?? '';
        $this->listening_obtain = $data->listening_obtain ?? '';
        $this->reading_marks = $data->reading_marks ?? '';
        $this->reading_obtain = $data->reading_obtain ?? '';
        $this->speaking_marks = $data->speaking_marks ?? '';
        $this->speaking_obtain = $data->speaking_obtain ?? '';
        $this->writing_marks = $data->writing_marks ?? '';
        $this->writing_obtain = $data->writing_obtain ?? '';
        $this->avg_of_marks = $data->avg_of_marks ?? '';
        $this->avg_of_obtain = $data->avg_of_obtain ?? '';
        $this->total = $data->total ?? '';
        $this->feedback = $data->feedback ?? '';
    }

    public function updatedActiveAssesment(){
        $this->showAssesment($this->activeAssesment);
    }

    public function render()
    {

        // get assigned leads 
        $this->students = LeadStatus::has('userRelation')->where(['assignedto'=>auth()->user()->id,'is_paid' => '1'])->select('leadid')->distinct('leadid')->get();

        $this->activeLead =  Classes::where(['seniortrainer_id'=>auth()->user()->id, 'leadid'=>$this->lead_id])->latest()->first();
        $this->username=ucwords(userName($this->lead_id??''));
        
        
        $this->performance = round(Performance::where('lead_id',$this->lead_id)->avg('total'),2);
        
        $feedback = Classes::has('feedbackRelation')->where(['leadid'=>$this->lead_id, 'seniortrainer_id'=>auth()->user()->id])->latest()->first();
        
        $this->classfeedback = $feedback->feedbackRelation->feedback_type ?? 0;
        
        $this->assesments = Performance::where('lead_id',$this->lead_id)->get();
        
        $data = Classes::query();
        $data = $data->where(['leadid'=>$this->lead_id, 'seniortrainer_id'=>auth()->user()->id]);
        if ($this->search) {
            $data = $data->where('class_date', 'LIKE', "%{$this->search}%");
        }
        $classDetails = $data->paginate($this->paginate);
        
        
        return view('livewire.trainer.qa-manager.student-performance',[ 'classDetails'=>$classDetails])->layout('layouts.new-app');
    }
}