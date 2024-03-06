<?php

namespace App\Http\Livewire\Courses;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SubDepartment;
use App\Models\DiscountManagment;

class Discountmanager extends Component
{
    use WithPagination;
    // render variable 
    public $editId=0, $amount, $role, $department, $errormessage, $subdepartmentData;

    // search and pagination of table
    public $search, $paginate=10;

    public function mount()
    {
        $this->subdepartmentData=SubDepartment::where('is_active','1')->get();
    }

    public function edit($id){
        $data = DiscountManagment::findorFail($id);
        $this->editId=$id;
        $this->amount=$data->amount;
        $this->role=$data->role;
        $this->department=$data->department;

    }

    public function resetInputs(){
        $this->editId=0;
        $this->amount='';
        $this->role='';
        $this->department='';
        $this->errormessage='';
    }

    public function update(){
        $validateddata=  $this->validate([
            'amount' => 'required|numeric|between:0,99.99',
            'role' => 'required',
            'department' => 'required',
        ]);
        // store here subdepartment id 
        $subdepartment = SubDepartment::findorFail($this->department);

        $alreadyexists = DiscountManagment::where('id','!=',$this->editId)->where(['department'=>$subdepartment->departments_id,'sub_department'=>$this->department, 'role'=>$this->role])->exists();
        $validateddata['department']=$subdepartment->departments_id;
        $validateddata['sub_department']=$this->department;
        
        if ($alreadyexists) {
            $this->errormessage="Already exists";
        }else {
            
            if ($this->editId) {
                DiscountManagment::findorFail($this->editId)->update($validateddata);
            } else {
                DiscountManagment::create($validateddata);
            }
            
           $status = $this->editId ? 'Update' : 'Create';
           $this->resetInputs();
           $this->emit('flashmessage', "Discount $status successfully");
        }
    }

    public function render()
    {
        $data=DiscountManagment::query();
        if ($this->search) {
            $data = $data->where('amount', 'LIKE', "%{$this->search}%");
        } 
        $data = $data->paginate($this->paginate);
        return view('livewire.courses.discountmanager',compact('data'))->layout('layouts.new-app');
    }
}
