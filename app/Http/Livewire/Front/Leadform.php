<?php

namespace App\Http\Livewire\Front;

use App\Models\LeadStatus;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Services\WhatsappService;

class Leadform extends Component
{
    public $name, $countrycode, $mobile, $email, $state, $reference;

    public function resetInputs(){
        $this->name = '';
        $this->countrycode = '';
        $this->mobile = '';
        $this->email = '';
        $this->state = '';
        $this->reference = '';
    }

    protected  $rules = [];

    public function mount(){
        $this->rules = $this->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'mobile' => 'required|unique:users,mobile|numeric|size:10',
        'countrycode' => 'required',
        'state' => 'required',
        'reference' => 'required',
        ];
    }

    public function store(){
        $this->validate(); 
        
        $password=Hash::make($this->mobile);
        $userdata=['name'=>$this->name,'email'=>$this->email,'mobile'=>$this->mobile,'mobilecode'=>$this->countrycode,'password'=>$password,'user_type'=>2];
        $registeruser=User::create($userdata);
        $userdetails=['user_id'=>$registeruser->id,'state'=>$this->state,'refrence'=>$this->reference];
        $userdetails= UserDetail::create($userdetails);

        // get last created lead 
        $lastassignment=LeadStatus::latest()->first();
        if ($lastassignment) {
            $assignedto=0;
            $sesiorsales=User::where(['department'=>3,'role'=>2,'user_type'=>1])->pluck('id')->toArray();
            $lastleadassignedto=LeadStatus::latest()->first()->assignedto;
            $key = array_search($lastleadassignedto, $sesiorsales);
            $lastindex=count($sesiorsales)-1;

            // if senior sale is last from rows then assign to first senior sales
            if ($lastindex == $key) {
                $assignedto=$sesiorsales[0];
            }else{
                $assignedto=$sesiorsales[$key+1];
            }
            LeadStatus::create(['leadid'=>$registeruser->id,'assignedby'=>0,'assignedto'=>$assignedto,'level'=>2,'leadtype'=>1,'department'=>3,'comments'=>'System Assigned!']);
            // leadassignedtoseniorsales($assignedto,$registeruser->id);
           
           
        }else{
            
            // if last created lead is null then assign lead to first senior sales 
            $sesiorsales=User::where(['department'=>3,'role'=>2])->first();
            $assignedto=0;
            if ($sesiorsales) {
                $assignedto=$sesiorsales->id;
            }
            LeadStatus::create(['leadid'=>$registeruser->id,'assignedby'=>0,'assignedto'=>$assignedto,'level'=>2,'leadtype'=>1,'department'=>3,'comments'=>'System Assigned!']);
            // leadassignedtoseniorsales($assignedto,$registeruser->id);
        }
        WhatsappService::optin($this->mobile);
        $url=url('/');
        $message="Welcome to orad. Here are your username: ".$this->mobile." password: ".$this->mobile." . Follow this link ".$url." for more details.";
        WhatsappService::sendmessage($message,$this->mobile);
        $this->resetInputs();
        $this->emit('flashmessage', 'Thank you for contacting us!');
    }

    public function render()
    {
        return view('livewire.front.leadform')
                 ->layout('layouts.appfront');
    }
}
