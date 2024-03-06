<?php

namespace App\Http\Livewire\Auth;
use App\Models\User;
use Livewire\Component;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ChangePasswordNew extends Component
{
    public $userId, $currentpassword,$newpassword,$confirmnewpassword;

    public function mount(){
        $this->userId = auth()->user()->id;
    }


    public function changePassword(){
        $this->validate([
            'currentpassword' => ['required', new MatchOldPassword],
            'newpassword' => ['required'],
            'confirmnewpassword' => ['required','same:newpassword'],
        ],[
            'currentpassword.required' => 'old password field is required',
            'newpassword.required' => 'new password field is required',
            'confirmnewpassword.required' => 'confirm password field is required',
        ]);
        $newpassword=$this->newpassword;
        $changedpassword=Hash::make($newpassword);
        User::findorFail($this->userId)->update(['password'=>$changedpassword]);
        $this->resetInputs();
        $this->emit('flashmessage','Password Changed Successfully!');
    }

    
    public function resetInputs(){
        $this->currentpassword='';
        $this->newpassword='';
        $this->confirmnewpassword='';
    }

    public function render()
    {
        return view('includes.change-password', ['userId'=>$this->userId, 'formRoute'=>'changePassword'])->layout('layouts.new-app');
        
    }
}
