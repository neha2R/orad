<?php

namespace App\Http\Livewire\Admin;


use App\Models\User;
use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use App\Models\SubDepartment;
use App\Services\ActionsService;

class Userassignment extends Component
{
    use WithPagination;
    public $departments;
    public $seniors=[];
    public $juniors=[];
    public $selecteddepartment;
    public $selectedsenior;
    public $selectedjunior=[];

    
    public $showassigned=false;

    public $seniorforselectedforview;



    protected $listeners = ['showJuniors' => 'showJuniors','reset' => 'resetInputsedit'];

    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->departments=Department::where('is_active',1)->get();
       
    }

    public function updatedSelecteddepartment()
    {
        $this->seniors=User::where(['department'=>$this->selecteddepartment,'role'=>2])->get();
        $this->juniors=[];
    }

    public function updatedSelectedsenior(){
        $this->juniors=[];
        $this->juniors=User::where('parent_id',0)->where(['department'=>$this->selecteddepartment,'role'=>3])->get();
        $this->emit('multiselectoption',1);
    }


    public function store(){
        // dd($this->selectedsenior, $this->selectedjunior);
        $this->validate([
            'selectedsenior' => 'required',
            'selecteddepartment' => 'required',
            'selectedjunior' => 'required',
        ]);
        $parentid=$this->selectedsenior;
        $updateAssignedStatus=User::whereIn('id',$this->selectedjunior)->update(['parent_id'=>$parentid]);
        foreach ($this->selectedjunior as $key => $value) {
            $username=User::findorFail($value);
            $senior=User::findorFail($parentid);
            ActionsService::newjuniorassignmentundersenior($parentid,$value);
            // userassignmentprocess($username->name,$senior->name,$parentid,$value);
        }
        $this->resetInputs();
    }

    public function showJuniors($id){

        $this->seniorforselectedforview=$id;
        $this->showassigned=true;
        $this->emit('showdetailmodal',1);
    }

    public function unAssignTrainee($id){
        User::findorFail($id)->update(['parent_id'=>0]);

    }
    public function resetInputs(){
        $this->departments;
        $this->seniors=[];
        $this->juniors=[];
        $this->selecteddepartment='';
        $this->selectedsenior='';
        $this->selectedjunior=[];
    }


    public function render()
    {
        return view('livewire.admin.userassignment',[
            'seniorstaff'=>User::where('user_type',1)->where('role','!=',3)->where(['is_active'=>1])->paginate(10),
            'showjuniorlist'=>User::where('parent_id',$this->seniorforselectedforview)->where('is_active',1)->get()
        ]);
    }
}
