<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\OurClient;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class OurClients extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $pageheading = 'Our Clients';

    public $editId, $name, $description, $photo ;

    // search and pagination of table
    public $search, $paginate=10;

    protected $listeners = ['reset' => 'resetInputs', 'taginputevent' => 'taginput'];

    public function store(){
        $validateddata=  $this->validate([
            'name' => 'required',
            'description' => 'required',
            
        ]);

        if ($this->photo) {
          $validateddata['photo']=$this->photo->store('clients','public');
        }
        $this->editId ? OurClient::findorFail($this->editId)->update($validateddata) : OurClient::create($validateddata);
        
        $status = $this->editId ? 'Update' : 'Create';
        $this->emit('flashmessage', "Data $status successfully");
        $this->resetInputs();
    }

    public function edit($id){
        $editdata = OurClient::findorFail($id);
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
        OurClient::findorFail($id)->update(['is_active' => "$status"]);
        $this->emit('flashmessage', 'Status changed successfully');
    }
    



    public function render()
    {
        $data = OurClient::query();
        if ($this->search) {
            $data = $data->where('name', 'LIKE', "%{$this->search}%")->orWhere('description', 'LIKE', "%{$this->search}%");
        } 
        $data = $data->paginate($this->paginate);
        return view('livewire.admin.our-clients', ['data' => $data])->layout('layouts.new-app');
    }
}
