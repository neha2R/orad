<?php

namespace App\Http\Livewire\Student;

use App\Models\Classes;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\LeadStatus;
use Livewire\WithPagination;
use App\Models\ClassFeedback;
use App\Models\CoursePayments;
use App\Models\StudentPerformance as Performance;

class Reports extends Component
{
    use WithPagination;

    // render variables 
    public $assesments=[], $activeAssesment, $performance, $classfeedback;

    // assessment variables 
    public $date, $topics, $lead_id, $qa_id, $username;
    
    // parameter, feedback and marks variables 
    public $listening_marks, $listening_obtain, $reading_marks, $reading_obtain, $speaking_marks, $speaking_obtain, $writing_marks, $writing_obtain, $feedback;
    
    // result variables 
    public $avg_of_marks, $avg_of_obtain, $total;

    public $paginate=10;

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
        
        $this->username=ucwords(auth()->user()->name);

        $this->performance = round(Performance::where('lead_id',auth()->user()->id)->avg('total'),2);
        $this->assesments = Performance::where('lead_id',auth()->user()->id)->get();
    }

    /**
     * show specific assesment details
     * 
     * @param int assesmentid
     * @return response
     */
    public function updatedActiveAssesment(){
        $data = Performance::find($this->activeAssesment);
        if ($data) {
            $this->date = $data->date;
            $this->topics = $data->topics;
    
            $this->listening_marks = $data->listening_marks;
            $this->listening_obtain = $data->listening_obtain;
            $this->reading_marks = $data->reading_marks;
            $this->reading_obtain = $data->reading_obtain;
            $this->speaking_marks = $data->speaking_marks;
            $this->speaking_obtain = $data->speaking_obtain;
            $this->writing_marks = $data->writing_marks;
            $this->writing_obtain = $data->writing_obtain;
            $this->avg_of_marks = $data->avg_of_marks;
            $this->avg_of_obtain = $data->avg_of_obtain;
            $this->total = $data->total;
            $this->feedback = $data->feedback;
        }
    }

    public function render(){
        return view('livewire.student.reports')->layout('layouts.new-app');
    }
}