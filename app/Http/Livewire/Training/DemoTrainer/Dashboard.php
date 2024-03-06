<?php

namespace App\Http\Livewire\Training\DemoTrainer;

use App\Models\Demo;
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
use App\Http\Traits\DemoFeedbackTrait;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\LeadRegistrationTrait;
use App\Http\Traits\LeadHistoryTrait;
use App\Services\InappNotificationService;

class Dashboard extends Component
{
    use WithPagination, DemoFeedbackTrait, LeadHistoryTrait, LeadRegistrationTrait;

    // card variables 
    public $leadStatus=0,$pendingDemo=0,$demoDone=0,$leadhistorydata=[],$leadstatusfordemo=0, $activeLeads="Pending Demo", $convertedleads=0,$followupleadstats=0;
    

    // reschedule variables 
    public $trainerSlots=[], $rescheduleLeads=[], $demoDate, $demoid, $join_link;

    // search and pagination of table
    public $search, $paginate=10;

    public function mount(){
        $this->trainerSlots = ProvideSlot::where(['trainer_id'=>auth()->user()->id])->get();
        
        $this->rescheduleLeads = Demo::where(['trainerid'=>auth()->user()->id, 'is_demodone'=>'0'])->get();
        $this->demoLeads = Demo::where(['trainerid'=>auth()->user()->id])->get();
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

        Demo::find($this->demoid)->update(['demolink'=>$this->join_link]);
        $this->emit('flashmessage', 'Link added successfully...');
    }

    public function updatedSlot(){
        $this->errormessage='';
    }

    /**
     * Reschedule dmeo 
     * 
     * @param Date demodate
     * @param Integer demoid
     * @param Time timeslot
     * @return response
     */
    public function rescheduleDemo(){
        $validatedData = $this->validate([
            'demoDate'=>'required',
            'slot'=>'required',
            'demoid'=>'required',
        ]);

        $date = date('Y-m-d',strtotime($this->demoDate));

        $demoData = Demo::findorFail($this->demoid);
        
          
        // check if assignto slot is already booked
        $alreadyExists = TrainerSlots::where(['trainer_id'=>auth()->user()->id, 'slot_id'=>$this->slot, 'date'=>$date])->where('lead_id','!=',$demoData->leadid)->exists();

        if ($alreadyExists) {
            $this->errormessage = 'This slot is already booked';
        }
        
        if (!$this->errormessage) {
            
            // update lead status table 
            $trainerLeadStatus = LeadStatus::where(['assignedto'=>auth()->user()->id, 'leadid'=>$demoData->leadid])->first();
            if ($trainerLeadStatus) {
                $trainerLeadStatus->update(['demoid'=>$this->demoid, 'is_rescheduled'=>'1']);
            }
            
            // update demo date and slot 
            $demoData = $demoData->update(['date'=>$date, 'slot'=>$this->slot, 'is_rescheduled'=>'1']);
            
            $this->resetRescheduleInput();
            $this->statsRefresh();
            $this->emit('flashmessage', 'Demo reschedule successfully...');
        }
    }

    public function resetRescheduleInput()
    {
        $this->demoDate = '';
        $this->slot = '';
        $this->demoid = '';
    }

    public function demoStatus($id){
        $this->leadStatus=$id;
        $this->activeLeads= !$id ? 'Pending Demo' : 'Demo Done';
        $this->statsRefresh();
    }

    public function statsRefresh(){
        $this->demoDone = Demo::where(['trainerid' => auth()->user()->id, 'is_demodone' => '1'])->count();
        $this->pendingDemo = Demo::where(['trainerid' => auth()->user()->id, 'is_demodone' => '0'])->count();
    }


    public function render()
    {
        $leadids = Demo::query();
        $data = $leadids->where(['trainerid' => auth()->user()->id, 'is_demodone' => "$this->leadStatus"]);
        if ($this->search) {
            $searchTerm=$this->search;
            $data = $leadids->whereHas('userRelation', function($query) use($searchTerm){
                $query->where('name', 'LIKE', "%{$searchTerm}%") 
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
               });
        }
        $data = $data->orderBy('id','desc')->paginate($this->paginate);


        return view('livewire.trainer.demo-trainer.dashboard',['data' => $data])->layout('layouts.new-app');
    }
}