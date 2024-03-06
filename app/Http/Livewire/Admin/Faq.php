<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Faq as FAQModel;

class Faq extends Component
{
    use WithPagination;

    public $pageheading = 'Faq';

    // render variables 
    public $editId, $title, $description, $showInPolicy ;

    // search and pagination of table
    public $search, $paginate=10;


    protected $listeners = ['reset' => 'resetInputs', 'taginputevent' => 'taginput'];

    public function store(){
        $validateddata=  $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $validateddata['include_in_policy']= $this->showInPolicy ? '1' : '0';
        
        $this->editId ? FAQModel::findorFail($this->editId)->update($validateddata) :FAQModel::create($validateddata);
        $status = $this->editId ? 'Update' : 'Create';
        $this->emit('flashmessage', "FAQ $status successfully");
        $this->resetInputs();
    }

    public function edit($id){
        $editdata = FAQModel::findorFail($id);
        $this->editId = $id;
        $this->title = $editdata->title;
        $this->description = $editdata->description;
        $this->showInPolicy = $editdata->include_in_policy;
        
    }

    public function resetInputs(){
        $this->editId = '';
        $this->title = '';
        $this->description = '';
        $this->showInPolicy = '';

    }

    public function changestatus($id, $status){
        $status = 1- $status;
        FAQModel::findorFail($id)->update(['is_active' => "$status"]);
        $this->emit('flashmessage', 'Status changed successfully');
    }
    

    public function changePolicyStatus($id, $status){
        $status = 1- $status;
        FAQModel::findorFail($id)->update(['include_in_policy' => "$status"]);
        $this->emit('flashmessage', 'Status changed successfully');
    }

    public function render()
    {
        $data = FAQModel::query();
        if ($this->search) {
            $data = $data->where('title', 'LIKE', "%{$this->search}%")->orWhere('description', 'LIKE', "%{$this->search}%");
        } 
        $data = $data->paginate($this->paginate);
        return view('livewire.admin.faq', ['data' => $data])->layout('layouts.new-app');
    }
}
