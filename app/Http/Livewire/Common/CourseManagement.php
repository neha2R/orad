<?php

namespace App\Http\Livewire\Common;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Classes;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CoursePayments;

class CourseManagement extends Component
{
    use WithPagination;

    // render variables  
    public $activeCourse=0, $courseName, $courseType, $studentName, $timeslot, $startDate, $courseDuration;

    // search and pagination of table
    public $search, $paginate=10;

    public function changeStatus($id){
        $this->activeCourse = $id;
    }
    
    public function resetInputs(){
        $this->courseName = '';
        $this->courseType = '';
        $this->studentName = '';
        $this->timeslot = '';
        $this->startDate = '';
        $this->courseDuration = '';
    }

    public function show($id){
        $data = CoursePayments::find($id);
        
        $this->courseName = $data->course->name ?? '';
        $this->courseType = $data->course ? $data->course->Course->course_type ? 'Personale' : 'Group' : '';
        $this->studentName = $data->student->name ?? '';
        $this->timeslot = slotDetails($data->student->slot_id ?? null);
        $this->startDate = $data->classesRelation != null ? $data->classesRelation->created_at->format('d M Y') ?? '' : '';
        $this->courseDuration = $data->course->days ?? '';
    }

    public function render()
    {
        $leads = Classes::query();
        if (auth()->user()->role == 2) {
            $leads = $leads->where('seniortrainer_id',auth()->user()->id);
        }else {
            $leads = $leads->where('trainerid',auth()->user()->id);
        }
        $leadsIds = $leads->select('leadid')->distinct('leadid')->get()->pluck('leadid')->toArray();
        
        $data = CoursePayments::query();
        $data = $data->where('payment_success','1');
        $data = $data->whereIn('customer_id',$leadsIds);
        if ($this->search) {
            $searchTerm = $this->search;
            $data = $data->where(function ($raw) use ($searchTerm)
            {
                return $raw->whereHas('course', function ($query) use($searchTerm)
                {
                    return $query->where('name', 'LIKE', "%{$searchTerm}%");
                    
                })->orWhereHas('student', function ($query) use($searchTerm)
                {
                    return $query->where('name', 'LIKE', "%{$searchTerm}%");
                    
                });
            });
        }
        $data = $data->paginate($this->paginate);
        
        return view('includes.course-management',['data'=>$data])->layout('layouts.new-app');
        
    }
}
