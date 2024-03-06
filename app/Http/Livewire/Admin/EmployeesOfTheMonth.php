<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\EmployeeOfTheMonth as EmpMonthTable;

class EmployeesOfTheMonth extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $componentName='Data';

    public $pageheading = 'Employee of the month';

    public $editId, $name, $description, $photo ;

    // search and pagination of table
    public $search, $paginate=10;


    public function store(){
        $validateddata=  $this->validate([
            'name' => 'required',
            'description' => 'required',
            
        ]);

        if ($this->photo) {
          $validateddata['photo']=$this->photo->store('employees','public');
        }
        $this->editId ? EmpMonthTable::findorFail($this->editId)->update($validateddata) : EmpMonthTable::create($validateddata);
        $status = $this->editId ? 'Update' : 'Create';
        $this->emit('flashmessage', "Data $status successfully");
        $this->resetInputs();
    }

    public function edit($id){
        $editdata = EmpMonthTable::findorFail($id);
        $this->editId = $id;
        $this->name = $editdata->name;
        $this->description = $editdata->description;
        
    }


    public function resetInputs(){
        $this->editId = '';
        $this->name = '';
        $this->description = '';
        $this->photo = '';

    }


    public function changestatus($id, $status){
        $status = 1- $status;
        EmpMonthTable::findorFail($id)->update(['is_active' => "$status"]);
        $this->emit('flashmessage', 'Status changed successfully');
    }

    public function render()
    {
        $data = EmpMonthTable::query();
        if ($this->search) {
            $data = $data->where('name', 'LIKE', "%{$this->search}%")->orWhere('description', 'LIKE', "%{$this->search}%");
        } 
        $data = $data->paginate($this->paginate);
        return view('livewire.admin.emp-of-month', ['data' => $data])->layout('layouts.new-app');
    }
}
