<?php

namespace App\Http\Livewire\Admin;

use App\Models\ContentCategory;
use App\Models\ContentSubcategory as AppContentSubcategory;
use Livewire\Component;
use Livewire\WithPagination;

class ContentSubcategory extends Component
{
    use WithPagination;

    public $pageheading = 'Manage Sub-Categories';
    public $categories, $name, $category, $editid, $search;
    
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['reset' => 'resetInputs'];

    protected $rules = [
        'name' => 'required',
        'category' => 'required',
    ];

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function store(){
        $this->validate();
        AppContentSubcategory::create(['name' => $this->name, 'category' => $this->category]);
        $this->resetInputs();
        $this->emit('flashMessage', 'Sub-category added successfully');
    }

    public function edit($id){
        $editdata = AppContentSubcategory::findorFail($id);
        $this->editid = $id;
        $this->name = $editdata->name;
        $this->category = $editdata->category;
    }

    public function update(){
        $this->validate();
        AppContentSubcategory::findorFail($this->editid)->update(['name' => $this->name, 'category' => $this->category]);
        $this->emit('flashMessage', 'Sub-category updated successfully');
        $this->resetInputs();
    }

    public function changestatus($id, $status){
        $status = 1-$status;
        AppContentSubcategory::findorFail($id)->update(['is_active' => $status]);
        $this->emit('flashMessage', 'Status changed successfully');
    }

    public function resetInputs(){
        $this->name = '';
        $this->category = '';
    }

    public function render()
    {
        if ($this->search) {
            $data = AppContentSubcategory::where('name', 'LIKE', "%{$this->search}%")->paginate(10);
        } else {
            $data = AppContentSubcategory::paginate(10);
        }
        $this->categories = ContentCategory::all();
        return view('livewire.admin.content-subcategory', ['data' => $data])->layout('layouts.app', ['pageheading' => $this->pageheading]);
    }
}
