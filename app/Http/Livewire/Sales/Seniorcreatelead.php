<?php

namespace App\Http\Livewire\Sales;

use Livewire\Component;
use App\Services\WhatsappService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\UserDetail;
use App\Models\LeadStatus;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Services\InappNotificationService;

class Seniorcreatelead extends Component
{ 
    use WithPagination,WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $name,$email,$countrycode,$mobile,$state,$reference,$growth,$edulevel,$gender,$langaugesknown,$comments,$seniorsalesid,$seniorsalespeople;
    public $fileimport,$errormessage=[],$iteration,$mobilecode,$whatsappnumber,$leadtype,$leadkeyword;
    protected $listeners = [ 'taginputevent' => 'taginput'];
    public function taginput(){
        $this->emit('taginput', 1);
    }

    public function save(){
        $errors=collect();
        try {
            Excel::import(new UsersImport(2),$this->fileimport);
             $this->fileimport=null;
             $this->iteration++;
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             foreach ($failures as $failure) {
                 $message="You can't import lead on line ". $failure->row() ." ".implode(" ",$failure->errors())."";
                 $errors->push($message);
             }
             $this->errormessage=$errors;
             $this->fileimport=null;
             $this->iteration++;
            //  return redirect()->back('')
        }
       
    }
    public function rules()
    {
        return [
        'name' => 'required|min:3',
        'email' => 'nullable',
        'mobile' => 'required|unique:users,mobile,',
        'mobilecode' => 'required',
        'state' => 'required',
        'reference' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(){
    //   $this->seniorsalespeople= User::where(['department'=>3,'role'=>2,'user_type'=>1])->get();
    }

    public function resetInputs(){
        $this->name='';
        $this->email='';
        $this->mobile='';
        $this->countrycode='';
        $this->state='';
        $this->reference='';
        $this->growth='';
        $this->edulevel='';
        $this->gender='';
        $this->langaugesknown='';
        $this->comments='';
        $this->leadkeyword='';
        $this->whatsappnumber='';
        $this->leadtype=1;
    }

    public function update(){
        // dd($this->seniorsalesid);
        $this->validate(); 
        $password=Hash::make($this->mobile);
        $userdata=['name'=>$this->name,'email'=>$this->email,'mobile'=>$this->mobile,
        'whatsappnumber'=>$this->whatsappnumber,'leadtype'=>$this->leadtype,'leadkeyword'=>$this->leadkeyword,
        'mobilecode'=>$this->mobilecode,'password'=>$password,'user_type'=>2];
        $registeruser=User::create($userdata);
        $userdetails=['user_id'=>$registeruser->id,'state'=>$this->state,'refrence'=>$this->reference,'growth'=>$this->growth,'edulevel'=>$this->edulevel,'gender'=>$this->gender,'comments'=>$this->comments];
        $userdetails= UserDetail::create($userdetails);
        $assignedto=auth()->user()->id;
        LeadStatus::create(['leadid'=>$registeruser->id,'assignedby'=>0,'assignedto'=>$assignedto,'level'=>2,'leadtype'=>1,'department'=>3,'comments'=>'System Assigned!']);
        // leadassignedtoseniorsales($assignedto,$registeruser->id);
        InappNotificationService::srmarketingcreatelead(auth()->user()->id,1);
        WhatsappService::optin($this->mobile);
        if ($this->whatsappnumber && $this->whatsappnumber !='') {
            WhatsappService::optin($this->whatsappnumber);
        }
        $this->emit('flashmessage', 'Lead generated successfully');
        $this->resetInputs();
    }
    public function render()
    {   
        $data=LeadStatus::where(['assignedby'=>0,'assignedto'=>auth()->user()->id])->orderBy('id','DESC')->paginate(10);
        return view('livewire.sales.seniorcreatelead',compact('data'));
    }
}


