<?php

namespace App\Http\Livewire\Admin;

use App\Models\Content as AppContent;
use App\Models\ContentCategory;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Content extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $pageheading = 'Manage Content';
    public $title, $description, $file, $category, $tags, $editID, $prefile, $search, $catfilter, $iteration=0;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['reset' => 'resetInputs', 'taginputevent' => 'taginput'];

    public function resetInputs(){
        $this->title = '';
        $this->description = '';
        $this->file = null;
        $this->category = '';
        $this->tags = '';
        $this->iteration++;
    }

    // protected $rules = [
    //     'title' => 'required',
    //     'file' => 'required',
    //     'subcat' => 'required'
    // ];

    public function taginput(){
        $this->emit('taginput', 1);
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function store(){
        $this->validate([
            'title' => 'required',
            'file' => 'required',
            'category' => 'required',
            // 'tags' => 'required'
        ]);
        if ($this->file) {
            $filename = time().'-'.$this->file->getClientOriginalName();
            $filesave = $this->file->storeAs('content', $filename, 'public');
            $tag = "hello,test";
            $tag = explode(",",$tag);
            $tags = json_encode($tag);
            AppContent::create(['title' => $this->title, 'description' => $this->description, 'file' => $filesave, 'category' => $this->category, 'tags' => $tags]);
            $this->emit('flashMessage', 'Content created successfully');
            $this->resetInputs();
        }
    }

    public function changestatus($id, $status){
        $status = 1 - $status;
        AppContent::findorFail($id)->update(['is_active' => $status]);
        $this->emit('flashMessage', 'Status changed successfully');
    }

    public function edit($id){
        $editdata = AppContent::findorFail($id);
        $this->editID = $id;
        $this->title = $editdata->title;
        $this->description = $editdata->description;
        $this->category = $editdata->category;
        $tag = json_decode($editdata->tags);
        $this->tags = implode(",",$tag);
        $this->prefile = $editdata->file;
    }

    public function update(){
        $this->validate([
            'title' => 'required',
            'category' => 'required',
            // 'tags' => 'required'
        ]);
        $tag = "hello,test";
        $tag = explode(",",$tag);
        $tags = json_encode($tag);
        if ($this->file) {
            $filename = time().'-'.$this->file->getClientOriginalName();
            $filesave = $this->file->storeAs('content', $filename, 'public');
            AppContent::where('id', $this->editID)->update(['title' => $this->title, 'description' => $this->description, 'file' => $filesave, 'category' => $this->category, 'tags' => $tags]);
        }
        else{
            AppContent::where('id', $this->editID)->update(['title' => $this->title, 'description' => $this->description, 'category' => $this->category, 'tags' => $tags]);
        }
        $this->emit('flashMessage', 'Content updated successfully');
        $this->resetInputs();
    }

    public function render()
    {
        $data = AppContent::query();
        if ($this->search) {
            $data = $data->where('title', 'LIKE', "%{$this->search}%")->orWhere('description', 'LIKE', "%{$this->search}%")->orWhere('tags', 'LIKE', "%{$this->search}%");
        }
        if ($this->catfilter) {
            $data = $data->where('category', $this->catfilter);
        }
        $data = $data->paginate(10);
        $categories = ContentCategory::all();
        return view('livewire.admin.content', ['data' => $data, 'categories' => $categories])->layout('layouts.app', ['pageheading' => $this->pageheading]);
    }
}
