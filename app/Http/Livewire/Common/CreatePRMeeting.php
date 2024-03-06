<?php

namespace App\Http\Livewire\Common;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\PRJoinee;
use App\Models\Department;
use Livewire\WithPagination;
use App\Models\PerformanceReview;
use App\Events\PushNotificationEvent;
class CreatePRMeeting extends Component
{
    use WithPagination;

    // create variables  
    public $date, $time, $agenda, $department=[], $sub_department, $employee=[], $join_link;

    // render variables  
    public $departments_data=[], $employees_data=[], $feedbacks=[], $meetingname;

    // search and pagination of table
    public $search, $paginate=10;


    public function mount()
    {
        $this->departments_data=Department::where('is_active','1')->get();
        if (auth()->user()->department != '2') {
            $this->employees_data = User::where(['department'=>auth()->user()->department, 'sub_department'=>auth()->user()->sub_department,'role'=>'3'])->get();
        }
        
    }

    public function updatingDate(){
        $this->validate([
            'date' => 'required|date|after_or_equal:'.now()->format('Y-m-d')
        ]);
    }

    /**
     * get department wise employees data
     * 
     * @param array department_ids 
     * @return response
     */
    public function updatedDepartment()
    {
        $this->employees_data = User::whereIn('department',$this->department)->get();
    }

    public function store(){
        $url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        $validData = $this->validate([
            'date' => 'required|date',
            'time' => 'required',
            'agenda' => 'required|string|max:255',
            'department' => 'required',
            'employee' => 'required',
            'join_link' => 'required|regex:'.$url,
        ]);
        $date = date('M d,Y',strtotime($this->date));
        $time = date('g:iA', strtotime($this->time));
        $pr_meeting = PerformanceReview::create(['date'=>$this->date, 'time'=>$this->time,'agenda'=>$this->agenda, 'created_by'=>auth()->user()->id]);
        
        foreach ($this->employee as $key => $value) {
            $employee = User::find($value);
            $user = ucwords($employee->name);
            $joinees = PRJoinee::create(['performance_reviews_id'=>$pr_meeting->id, 'department'=>$employee->department, 'sub_department'=>$employee->sub_department ?? '0', 'employee_id'=>$value, 'join_link'=>$this->join_link]);

            new PushNotificationEvent($value, "Hello $user, The new meeting starts on $date at $time");
        }
        
        $this->emit('flashmessage','PR meeting created successfully!');
        $this->resetInputs();
    }

    /**
     * show specific pr meeting feedback
     * 
     * @param int meeting_id
     * @return response
     */
    public function show($meeting_id)
    {
        $this->meetingname = PerformanceReview::findorFail($meeting_id)->agenda;
        $this->feedbacks = PRJoinee::where('rating','!=','0')->where('performance_reviews_id',$meeting_id)->get();
        
    }
    
    public function resetInputs(){
        $this->date='';
        $this->agenda='';
        $this->department='';
        $this->sub_department='';
        $this->employee=[];
        $this->join_link='';
        $this->meetingname='';
        $this->feedbacks=[];
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        $data = PerformanceReview::query();
        // if(auth()->user()->role != '1'){
        //     $data = $data->where('created_by',auth()->user()->id);
        // }
        if ($this->search) {
            $searchTerm = $this->search;
            $data = $data->where('agenda', 'LIKE', "%{$this->search}%")
            ->orWhere('date', 'LIKE', "%{$this->search}%");
        }
        if(!$data)
        {
            $data = User::query();
            if ($this->search) {
                $searchTerm = $this->search;
                $data = $data->where('name', 'LIKE', "%{$this->search}%");
          
            }

        }
        $data = $data->paginate($this->paginate);
        
        return view('livewire.auth.create-meeting',['data'=>$data])->layout('layouts.new-app');
        
    }
}
