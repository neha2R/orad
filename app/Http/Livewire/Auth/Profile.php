<?php

namespace App\Http\Livewire\Auth;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    use WithFileUploads;
    
    public $userId, $name,$email,$mobile,$department,$role,$photo;

    public function mount(){
        $this->userId = auth()->user()->id;
        
        $this->name=auth()->user()->name;
        $this->email=auth()->user()->email;
        $this->mobile=auth()->user()->mobile;
        $this->department= auth()->user()->user_type == 2 ? 'Student' : auth()->user()->departmentRelation->name ;
        $this->role= auth()->user()->user_type == 2 ? 'Student' : rolesHelper(auth()->user()->role);
    }

    
    public function storeUserData()
    {
        if ($this->photo) {
            $data['profileimage'] = $this->photo->store('profile','public');
        }
        $data['name'] = $this->name;
        $data['mobile'] = $this->mobile;
        
        User::findorFail($this->userId)->update($data);
        
        $this->emit('flashmessage','Profile Updated Successfully!');
    }

    public function render()
    {
        return view('includes.profile', ['userId'=>auth()->user()->id, 'formRoute'=>'storeUserData'])->layout('layouts.new-app');
        
    }
}
