<?php

namespace App\Http\Livewire\Training\ClassTrainer;

use App\Models\Classes as ClassesSchedule;
use App\Models\User;
use Livewire\Component;
use App\Models\FeedBack;
use App\Models\LeadStatus;
use App\Models\UserDetail;
use App\Models\LeadHistory;
use App\Models\ProvideSlot;
use App\Imports\UsersImport;
use App\Models\TrainerSlots;
use Livewire\WithPagination;
use App\Services\WhatsappService;
use App\Http\Traits\ClassFeedbackTrait;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\LeadRegistrationTrait;
use App\Http\Traits\LeadHistoryTrait;
use App\Services\InappNotificationService;

class Dashboard extends Component
{
    use WithPagination, ClassFeedbackTrait, LeadHistoryTrait, LeadRegistrationTrait;

    // card variables 
    public $leadStatus=0,$pendingDemo=0,$demoDone=0,$leadhistorydata=[],$leadstatusfordemo=0, $activeLeads="Pending Class", $convertedleads=0,$followupleadstats=0;
    

    // reschedule variables 
    public $trainerSlots=[], $rescheduleLeads=[], $classDate, $demoid, $userrole, $join_link;

    // search and pagination of table
    public $search, $paginate=10;

    public function mount(){
        // $this->demoLeads = Demo::where(['trainerid'=>auth()->user()->id])->get();
        $this->userrole = auth()->user()->user_type;
        $this->statsRefresh();
    }

        /**
     * update demo id on click
     */
    public function updateDemoLink($link)
    {
        $this->demoid = $link;
    }

    public function storeLink()
    {
        $url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $validatedData = $this->validate(
            [
                'join_link' => 'required|regex:'.$url,
            ]
        );

        ClassesSchedule::find($this->demoid)->update(['classlink'=>$this->join_link]);
        $this->emit('flashmessage', 'Link added successfully...');
    }

    public function updatedClassDate()
    {
        $this->trainerSlots = TrainerSlots::where(['trainer_id'=>auth()->user()->id, 'date'=>$this->classDate])->get();
        $this->rescheduleLeads = ClassesSchedule::where(['trainerid'=>auth()->user()->id, 'student_attend'=>'0', 'class_date'=>$this->classDate])->get();
        
    }

    public function resetRescheduleInputs()
    {
        $this->classDate = '';
        $this->trainerSlots = [];
        $this->rescheduleLeads = [];
    }

    public function updatedSlot(){
        $this->errormessage='';
    }

    /**
     * Reschedule dmeo 
     * 
     * @param Date classDate
     * @param Integer demoid
     * @param Time timeslot
     * @return response
     */
    public function rescheduleDemo(){
        $validatedData = $this->validate([
            'classDate'=>'required',
            'slot'=>'required',
            'demoid'=>'required',
        ]);

        $date = date('Y-m-d',strtotime($this->classDate));

        $demoData = ClassesSchedule::findorFail($this->demoid);
        
          
        // check if assignto slot is already booked
        $alreadyExists = TrainerSlots::where(['trainer_id'=>auth()->user()->id, 'slot_id'=>$this->slot, 'date'=>$date])->where('lead_id','!=',$demoData->leadid)->exists();

        if ($alreadyExists) {
            $this->errormessage = 'This slot is already booked';
        }
        
        if (!$this->errormessage) {
            
            // update lead status table 
            // $trainerLeadStatus = LeadStatus::where(['assignedto'=>auth()->user()->id, 'leadid'=>$demoData->leadid])->first();
            // if ($trainerLeadStatus) {
            //     $trainerLeadStatus->update(['demoid'=>$this->demoid, 'is_rescheduled'=>'1']);
            // }
            
            // update demo date and slot 
            $demoData = $demoData->update(['class_date'=>$date, 'slot'=>$this->slot, 'is_reschedule'=>'1']);
            
            $this->resetRescheduleInput();
            $this->statsRefresh();
            $this->emit('flashmessage', 'Class reschedule successfully...');
        }
    }

    public function resetRescheduleInput()
    {
        $this->classDate = '';
        $this->slot = '';
        $this->demoid = '';
    }

    public function demoStatus($id){
        $this->leadStatus=$id;
        $this->activeLeads= !$id ? 'Pending Classes' : 'Classes Done';
        $this->statsRefresh();
    }

    public function statsRefresh(){
        $this->demoDone = ClassesSchedule::where(['trainerid' => auth()->user()->id, 'student_attend' => '1'])->count();
        $this->pendingDemo = ClassesSchedule::where(['trainerid' => auth()->user()->id, 'student_attend' => '0'])->count();
    }


    public function render()
    {
        $leadids = ClassesSchedule::query();
        $data = $leadids->where(['trainerid' => auth()->user()->id, 'student_attend' => "$this->leadStatus"]);
        if ($this->search) {
            $searchTerm=$this->search;
            $data = $leadids->whereHas('studentRelation', function($query) use($searchTerm){
                $query->where('name', 'LIKE', "%{$searchTerm}%") 
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
               });
        }
        $data = $data->orderBy('id','desc')->paginate($this->paginate);


        return view('livewire.trainer.class-trainer.dashboard',['data' => $data])->layout('layouts.new-app');
    }
}