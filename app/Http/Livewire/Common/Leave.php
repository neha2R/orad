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

class Leave extends Component
{
    use WithPagination;
    public $leaveType, $from, $to, $leaveFor, $totalDays, $leaveReason, $fromDate, $toDate, $errormessage;
    public $alreadyExists = false;

    // search and pagination of table
    public $search, $paginate=10;

    public function updatedFrom(){
        $this->validate([
            'from' => 'required|date|after_or_equal:'.now()->format('Y-m-d')
        ]);
        $this->fromDate = Carbon::createFromFormat('Y-m-d', $this->from);
        if ($this->to) {
            $this->toDate = Carbon::createFromFormat('Y-m-d', $this->to);
            $this->totalDays = $this->fromDate->diffInDays($this->toDate);
            $this->alreadyExists = LeaveTable::where('user_id',auth()->user()->id)->whereBetween('from',[$this->from, $this->to])->exists();
            if ($this->alreadyExists) {
                $this->errormessage = 'Leave already exists...';
            }
        }
    }
    public function updatedTo(){
        $this->validate([
            'to' => 'required|date|after_or_equal:'.now()->format('Y-m-d')
        ]);
        $this->fromDate = Carbon::createFromFormat('Y-m-d', $this->from);
        $this->toDate = Carbon::createFromFormat('Y-m-d', $this->to);
        $this->totalDays = $this->fromDate->diffInDays($this->toDate);
        $this->alreadyExists = LeaveTable::where('user_id',auth()->user()->id)->whereBetween('to',[$this->from, $this->to])->exists();
        if ($this->alreadyExists) {
            $this->errormessage = 'Leave already exists...';
        }
    }

    public function storeLeave(){
        $this->validate([
            'leaveType' => 'required',
            'from' => 'required|date|before:to',
            'to' => 'required|date|after:from',
            'leaveFor' => 'required',
            'leaveReason' => 'required',
        ]);
        $data['leave_type']=$this->leaveType;
        $data['leave_for']=$this->leaveFor;
        $data['from']=$this->fromDate;
        $data['to']=$this->toDate;
        $data['reason']=$this->leaveReason;
        $data['user_id']=auth()->user()->id;
        
        if(!$this->alreadyExists) {
            LeaveTable::create($data);
            $this->emit('flashmessage','Leave Apply Successfully!');
            $this->resetInputs();
        }
    }

    
    public function resetInputs(){
        $this->leaveType='';
        $this->from='';
        $this->to='';
        $this->leaveFor='';
        $this->leaveReason='';
        $this->errormessage='';
    }

    public function render()
    {
        
        $data = LeaveTable::query();
        $data = $data->where('user_id',auth()->user()->id);
        if ($this->search) {
            $data = $data->where('reason', 'LIKE', "%{$this->search}%")
            ->orWhere('from', 'LIKE', "%{$this->search}%")
            ->orWhere('to', 'LIKE', "%{$this->search}%");
        }
        $data = $data->paginate($this->paginate);
        
        return view('livewire.auth.leave',['data'=>$data])->layout('layouts.new-app');
        
    }
}
