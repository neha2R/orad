<?php

namespace App\Http\Livewire\Common;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Rules\MatchOldPassword;
use App\Models\Leave as LeaveTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LeaveApproval extends Component
{
    use WithPagination;
    public $leave_id , $leave_type, $from, $to, $leave_for, $total_days, $leave_reason, $status, $user_name, $department;


    // search and pagination of table
    public $search, $paginate=10;

    public function approvalStatus($status)
    {
        $this->status = $status;
    }

    public function storeLeave(){
        LeaveTable::findorFail($this->leave_id)->update(['status'=>"$this->status", 'approved_by'=>auth()->user()->id]);
        $this->emit('flashmessage','Status Update Successfully!');
        $this->status='';
    }

    public function totalDays($data)
    {
        $date = date_diff(date_create($data->from), date_create($data->to));
        return $date->format("%R%a days");
    }

    public function leaveStatus($id){
        $data = LeaveTable::findorFail($id);
        
        $this->leave_id= $id ;
        $this->user_name= $data->user->name ?? 'N/A' ;
        $this->department= $data->user->departmentDetails->title ?? 'N/A' ;
        $this->leave_type= $data->leave_type ;
        $this->from= $data->from ;
        $this->to= $data->to ;
        $this->leave_for= $data->leave_for ;
        $this->leave_reason= $data->reason ;
        $this->status= $data->status ;
        $this->approval_reason= $data->approval_reason ;
        $this->total_days= $this->totalDays($data);
    }

    public function render()
    {
        $data = LeaveTable::query();
        $data = $data->where('user_id','!=',auth()->user()->id);
        if ($this->search) {
            $data = $data->where('reason', 'LIKE', "%{$this->search}%")
            ->orWhere('from', 'LIKE', "%{$this->search}%")
            ->orWhere('to', 'LIKE', "%{$this->search}%");
        }
        $data = $data->paginate($this->paginate);
        
        return view('livewire.auth.leave-approval',['data'=>$data])->layout('layouts.new-app');
        
    }
}
