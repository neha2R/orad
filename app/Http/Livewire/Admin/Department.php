<?php

namespace App\Http\Livewire\Admin;

use App\Models\Department as AppDepartment;
use Livewire\Component;
use Livewire\WithPagination;

class Department extends Component
{
    use WithPagination;
    public $pageheading;
    public $name;
    public $editid, $search;
    public $updateMode = false;
    protected $paginationTheme = 'bootstrap';
    
    protected $listeners = ['reset' => 'resetInputs'];

    protected $rules = [
        'name' => 'required',
    ];

    public function mount(){
        $this->pageheading = 'Manage Departments';
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function store(){
        // dd($this->name);
        $this->validate();
        AppDepartment::create(['name'=>$this->name]);
        $this->resetInputs();
        $this->emit('flashMessage', 'Department added successfully');

    }

    public function resetInputs(){
        $this->name='';
    }

    public function changestatus($id, $status){
        $status = 1 - $status;
        AppDepartment::findorFail($id)->update(['is_active' => $status]);
        $this->emit('flashMessage', 'Status changed successfully');
    }

    public function edit($id){
        $this->updateMode = true;
        $editdata = AppDepartment::findorFail($id);
        $this->editid = $id;
        $this->name = $editdata->name;
    }

    public function update(){
        $this->validate();
        if ($this->editid) {
            AppDepartment::findorFail($this->editid)->update(['name' => $this->name]);
            $this->resetInputs();
            $this->emit('flashMessage', 'Department name updated successfully');
            $this->updateMode = false;
        }
    }

    public function render()
    {
        if ($this->search) {
            $data = AppDepartment::where('name', 'LIKE', "%{$this->search}%")->paginate(10);
        } else {
            $data = AppDepartment::paginate(10);
        }
        
        return view('livewire.admin.department', ['data' => $data])->layout('layouts.app', ['pageheading' => $this->pageheading]);
    }

}
