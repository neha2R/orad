<?php

namespace App\Http\Livewire\Admin;

use App\Models\Department;
use App\Models\SubDepartment;
use Livewire\Component;
use Livewire\WithPagination;

class SubDepartmentComponent extends Component
{
    use WithPagination;
    public $pageheading, $departments, $name, $department, $editid, $search;
    public $updateMode = false;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['reset' => 'resetInputs'];

    protected $rules = [
        'name' => 'required',
        'department' => 'required',
    ];

    public function mount(){
        $this->pageheading = 'Manage Sub-Departments';
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function store(){
        $this->validate();
        SubDepartment::create(['name' => $this->name, 'department' => $this->department]);
        $this->resetInputs();
        $this->emit('subdepAdded', 1);
    }

    public function edit($id){
        $updateMode = true;
        $editdata = SubDepartment::findorFail($id);
        $this->editid = $id;
        $this->name = $editdata->name;
        $this->department = $editdata->department;
    }

    public function update(){
        if ($this->editid) {
            $this->validate();
            SubDepartment::findorFail($this->editid)->update(['name' => $this->name, 'department' => $this->department]);
            $this->emit('flashMessage', 'Sub-Department updated successfully');
            $this->resetInputs();
            $updateMode = false;
        }
    }

    public function changestatus($id, $status){
        $status = 1-$status;
        SubDepartment::findorFail($id)->update(['is_active' => $status]);
        $this->emit('flashMessage', 'Status changed successfully');
    }

    public function resetInputs(){
        $this->name = '';
        $this->department = '';
    }

    public function render()
    {
        if ($this->search) {
            $data = SubDepartment::where('name', 'LIKE', "%{$this->search}%")->paginate(10);
        } else {
            $data = SubDepartment::paginate(10);
        }
        $this->departments = Department::all();
        return view('livewire.admin.sub-department-component', ['data' => $data])->layout('layouts.app', ['pageheading' => $this->pageheading]);
    }
}
