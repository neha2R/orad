<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Changepassword extends Component
{
    use WithFileUploads;
    
    public $name,$email,$mobile,$department,$role,$photo,$imageurl;
    public $currentpassword,$newpassword,$confirmnewpassword;

    public function mount(){
        $this->name=auth()->user()->name;
        $this->email=auth()->user()->email;
        $this->mobile=auth()->user()->mobile;
        $this->department=auth()->user()->departmentRelation->name;
        $this->role=rolesHelper(auth()->user()->role);
        $this->imageurl=Storage::disk('public')->url(auth()->user()->profileimage);
    }

    public function hydrate($image){
        // $this->photo='';
    }

    public function store(){
        $data=[];
        if ($this->photo) {
          $data['name']=$this->name;
          $data['profileimage']=$this->photo->store('profile','public');
        }
        
        $id=auth()->user()->id;
        $check=User::findorFail($id)->update($data);
        $this->resetInputs();
        $this->emit('flashMessage','Profile Updated Successfully!');
        return redirect('userprofile');
    }

    public function resetInputs(){
        $this->photo='';
        $this->currentpassword='';
        $this->newpassword='';
        $this->confirmnewpassword='';
    }


    public function changePassword(){
        $this->validate([
            'currentpassword' => ['required', new MatchOldPassword],
            'newpassword' => ['required'],
            'confirmnewpassword' => ['required','same:newpassword'],
        ]);
        $newpassword=$this->newpassword;
        $changedpassword=Hash::make($newpassword);
        User::findorFail(auth()->user()->id)->update(['password'=>$changedpassword]);
        $this->resetInputs();
        $this->emit('flashMessage','Password Changed Successfully!');
    }

    public function render()
    {
        return view('livewire.auth.changepassword');
    }
}
