<?php

namespace App\Http\Livewire\Training\DemoManager;

use App\Models\Demo;
use App\Models\Slot;
use App\Models\User;
use App\Models\Leave;
use Livewire\Component;
use App\Models\LeadStatus;
use App\Models\UserDetail;
use App\Models\LeadHistory;
use App\Models\ProvideSlot;
use App\Imports\UsersImport;
use App\Models\TrainerSlots;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Services\WhatsappService;
use App\Http\Traits\DemoFeedbackTrait;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\LeadHistoryTrait;
use App\Http\Traits\LeadRegistrationTrait;
use App\Services\InappNotificationService;

class Dashboard extends Component
{
    use WithPagination,WithFileUploads, LeadRegistrationTrait, LeadHistoryTrait;


    // card variables 
    public $assignedtable=0,$assignedleads=0,$unassignedleads=0, $demodone=0, $converted=0, $notconverted=0, $leadhistorydata=[],$leadstatusfordemo=0, $activeuser="Unassigned Leads", $assigntousers=[];
    
    // comment variables 
    public $leadhistorycomment='',$convertedleads=0,$followupleadstats=0;
    
    
    // assignement variables leadid, assign date, demo slot
    public $demoid, $leadid, $assignDate, $trainerid, $demo_slots=[], $assignto=0, $join_link, $slot;

    // search and pagination of table
    public $search, $paginate=10;

    public function mount(){
        $this->demo_slots = Slot::where('is_active','1')->get();
        $this->statsRefresh();
        
    }

    // set slot and date according to lead 
    public function updatedDemoid()
    {
        $leadDemoDetails = Demo::find($this->demoid);
        $this->slot = $leadDemoDetails->slot;
        $this->assignDate = $leadDemoDetails->date;
        $this->leadid = $leadDemoDetails->leadid;
        $this->checkAvailablity();
    }

    // check available trainer according to slot and date
    public function checkAvailablity(){
        $availableTrainers = ProvideSlot::where('slot_id', $this->slot)->distinct('trainer_id')->get()->pluck('trainer_id')->toArray();
        $busyTrainers = Demo::where(['slot'=>$this->slot, 'date'=> $this->assignDate])->whereNotNull('trainerid')->distinct('trainerid')->get()->pluck('trainerid')->toArray();
        if ($busyTrainers != null) {
            $availableTrainers = array_diff($availableTrainers, $busyTrainers);
        }
        
        // Demo trainer's lists
        $this->assigntousers = User::where('parent_id',auth()->user()->id)->whereIn('id', $availableTrainers)->orderBy('id','desc')->get();
    }


    public function updatedAssignDate(){
        $this->checkAvailablity();
        $this->errormessage='';
    }

    public function updatedSlot(){
        $this->checkAvailablity();
        $this->errormessage='';
    }

    public function updatedAssignto(){
        $this->errormessage='';
    }



    public function leadstatusstatsactive($id){
        $this->assignedtable=$id;
        switch ($this->assignedtable) {
            case 0:
                $this->activeuser='Unassigned Leads';
                break;
            
            case 1:
                $this->activeuser='Assigned Leads';
                break;
            
            case 2:
                $this->activeuser='Demo Completed Leads';
                break;
            
            
            case 3:
                $this->activeuser='Converted Leads';
                break;
            
            
            case 4:
                $this->activeuser='Not Converted Leads';
                break;
            default:
                $this->activeuser='Unassigned Leads';
                break;
        }
        $this->statsRefresh();
    }

    public function statsRefresh(){
        $this->assignedleads = Demo::where(['seniortrainer_id'=>auth()->user()->id,'is_demodone'=>'0'])->whereNotNull('trainerid')->count();
        $this->unassignedleads = Demo::where('seniortrainer_id',auth()->user()->id)->whereNull('trainerid')->count();
        $this->demodone = Demo::where(['seniortrainer_id'=>auth()->user()->id,'is_demodone'=>'1'])->whereNotNull('trainerid')->count();
        
        $this->converted = Demo::where(['seniortrainer_id'=>auth()->user()->id,'is_demodone'=>'1'])->whereHas('payment',function ($query)
        {
            $query->where('payment_success','1');
        })->count();
        $this->notconverted = Demo::where(['seniortrainer_id'=>auth()->user()->id,'is_demodone'=>'1'])->doesnthave('payment')->count();
    }


    /**
     * User assignement part
     */
    public function assignLead(){
        // $url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        
        $validatedData = $this->validate(
            [
                'leadid' => 'required',
                'assignto' => 'required',
                'slot' => 'required',
                'assignDate' => 'required',
                // 'join_link' => 'required|regex:'.$url,
            ]
        );
        
        $assignDate=  date('Y-m-d',strtotime($this->assignDate));

        // check if trainer is on leave
        $trainerIsOnLeave = Leave::where('user_id',"$this->assignto")->where('from','<=',$assignDate)->where('to','>=',$assignDate)->exists();
       
        if ($trainerIsOnLeave) {
            $this->errormessage = 'Trainer is not available on this date';
        }
        
        // check trainer slot available in provide_slots table
        $slotExists = ProvideSlot::where(['manager_id'=>auth()->user()->id, 'trainer_id'=>$this->assignto, 'slot_id'=>$this->slot])->exists();
        if (!$slotExists) {
            $this->errormessage = 'Slot not exists of this trainer';
        }
        
        // check if assignto slot is already booked
        $alreadyExists = TrainerSlots::where(['manager_id'=>auth()->user()->id, 'trainer_id'=>$this->assignto, 'slot_id'=>$this->slot, 'date'=>$assignDate])->exists();
        if ($alreadyExists) {
            $this->errormessage = 'This slot is already booked';
        }
        
        if (!$this->errormessage) {
            
    
            // transfer lead status for Demo Manager 
            $leadStatus = LeadStatus::where(['assignedto'=>auth()->user()->id, 'leadid'=>$this->leadid, 'is_transferred'=>'0'])->first();
            if ($leadStatus) {
                $leadStatus->is_transferred = '1';
                $leadStatus->save();
            }
    
            // create slot first 
            $createTrainerDemo = TrainerSlots::create(['manager_id'=>auth()->user()->id, 'trainer_id'=>$this->assignto, 'slot_id'=>$this->slot, 'date'=>$assignDate, 'lead_id'=>$this->leadid]);
            
    
    
            // create lead status table for demo trainer 
            $transferredLead = LeadStatus::create(['leadid'=>$this->leadid,'assignedby'=>auth()->user()->id,'assignedto'=>$this->assignto, 'assign_date'=>$assignDate, 'level'=>'4','leadtype'=>'1','department'=>'4', 'sub_department'=>'3','comments'=>'Lead transfer from Demo Manager to Demo Trainer']);
    
            // assign demo trainer id to demo table 
            $demoExists = Demo::where(['seniortrainer_id'=>auth()->user()->id, 'leadid'=>$this->leadid])->whereNull('trainerid')->first();
    
            if ($demoExists) {
                $updateDemoData = ['trainerid'=>$this->assignto, 'slot'=>$this->slot, 'date'=>$assignDate,  'leadstatus'=>$transferredLead->id];
                if($demoExists->date != $assignDate){
                    $updateDemoData['is_rescheduled'] = '1';
                }
                $demoExists->update($updateDemoData);
            }
            $client = User::findorFail($this->leadid);
            leadTransfer($client->mobile,$this->assignto,$client->id, 'Lead Transferred');
            // leadHistoryJuniorMarketingAssignment(auth()->user()->id,$this->assignto,$this->leadid);
            // InappNotificationService::srmarketingassignleadtojrmarketing($this->assignto,'1',auth()->user()->name);
            
            $this->statsRefresh();
            $this->resetInputsLead();
            $this->emit('flashmessage', 'Assigned successfully');
        }
    }


    public function render()
    {
        $leadids = Demo::query();
        $data = $leadids->where(['seniortrainer_id' => auth()->user()->id]);
        if (!$this->assignedtable) {
            $data = $data->whereNull('trainerid');
        }else {
            $data = $data->whereNotNull('trainerid');
            if ($this->assignedtable == '1') {
                $data = $data->where(['is_demodone'=>'0']);
            }
            else if ($this->assignedtable == '2') {
                $data = $data->where(['is_demodone'=>'1']);
            }elseif ($this->assignedtable == '3') {
                $data = $data->whereHas('payment',function ($query)
                {
                    $query->where('payment_success','1');
                });
            }else {
                $data = $data->where(['is_demodone'=>'0'])->doesnthave('payment');
            }
        }
         
        if ($this->search) {
            $searchTerm=$this->search;
            $data = $leadids->whereHas('userRelation', function($query) use($searchTerm){
                $query->where('name', 'LIKE', "%{$searchTerm}%") 
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
               })->orderBy('id','desc')->paginate($this->paginate);
        } else {
            $data = $leadids->orderBy('id','desc')->paginate($this->paginate);
        }


        // unassigned leads
        $unAssignedLeadsData = Demo::where(['seniortrainer_id' => auth()->user()->id])->whereNull('trainerid')->get();
        return view('livewire.trainer.demo-manager.dashboard',[
            'data' => $data,
            'unAssignedLead'=>$unAssignedLeadsData
        ])->layout('layouts.new-app');
    }
}