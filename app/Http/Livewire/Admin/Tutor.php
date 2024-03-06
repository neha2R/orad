<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\MeetOutTutor;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Tutor extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $componentName='Tutor';

    public $pageheading = 'Meet Our Tutor';

    public $editId, $name, $description, $video ;

   

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['reset' => 'resetInputs', 'taginputevent' => 'taginput'];

    public function store(){
        $validateddata=  $this->validate([
            'name' => 'required',
        ]);

        if ($this->video) {
          $validateddata['video']=$this->video->store('video','public');
        }
        if ($this->description) {
          $validateddata['description']=$this->description;
        }
        MeetOutTutor::create($validateddata);
        $this->emit('flashMessage', ''.$this->componentName.' added successfully');
        $this->resetInputs();
    }

    public function edit($id){
        $editdata = MeetOutTutor::findorFail($id);
        $this->editId = $id;
        $this->name = $editdata->name;
        $this->description = $editdata->description;
        
    }



    public function update(){
       $validateddata=  $this->validate([
            'name' => 'required',
        ]);

        if ($this->video) {
          $validateddata['video']=$this->video->store('video','public');
        }
        if ($this->description) {
          $validateddata['description']=$this->description;
        }
        $data = MeetOutTutor::findorFail($this->editId)->update($validateddata);
        
        $this->emit('flashMessage', ''.$this->componentName.' updated successfully');
        $this->resetInputs();
    }



    public function resetInputs(){
        $this->editId = '';
        $this->name = '';
        $this->description = '';
        $this->video = '';

    }





    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    

    public function changestatus($id, $status){
        $status = 1- $status;
        MeetOutTutor::findorFail($id)->update(['is_active' => "$status"]);
        $this->emit('flashMessage', 'Status changed successfully');
    }
    



    public function render()
    {
        $data = MeetOutTutor::query();
        $data = $data->paginate(10);
        return view('livewire.admin.tutor', ['data' => $data])->layout('layouts.app', ['pageheading' => $this->pageheading]);
    }
}
