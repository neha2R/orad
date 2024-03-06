<?php

namespace App\Http\Livewire\Content;

use App\Models\ContentCategory as AppContentCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ContentCategory extends Component
{
    use WithPagination;
    
    public $pageheading = 'Manage Content Category';
    public $name, $search, $editid;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['reset' => 'resetInputs'];

    protected $rules = [
        'name' => 'required',
    ];

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function store(){
        $this->validate();
        AppContentCategory::create(['name'=>$this->name]);
        $this->resetInputs();
        $this->emit('flashMessage', 'Category added successfully');

    }

    public function resetInputs(){
        $this->name='';
    }

    public function changestatus($id, $status){
        $status = 1-$status;
        AppContentCategory::findorFail($id)->update(['is_active' => $status]);
        $this->emit('flashMessage', 'Status changed successfully');
    }

    public function edit($id){
        $editdata = AppContentCategory::findorFail($id);
        $this->editid = $id;
        $this->name = $editdata->name;
    }

    public function update(){
        $this->validate();
            AppContentCategory::findorFail($this->editid)->update(['name' => $this->name]);
            $this->resetInputs();
            $this->emit('flashMessage', 'Category name updated successfully');
    }

    public function render()
    {
        if ($this->search) {
            $data = AppContentCategory::where('name', 'LIKE', "%{$this->search}%")->paginate(10);
        } else {
            $data = AppContentCategory::paginate(10);
        }
        return view('livewire.content.content-category', ['data' => $data])->layout('layouts.app', ['pageheading' => $this->pageheading]);
    }
}
