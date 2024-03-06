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

class Juniorcreatelead extends Component
{ 
    use WithPagination,WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $name,$email,$countrycode,$mobile,$state,$reference,$growth,$edulevel,$gender,$langaugesknown,$comments,$seniorsalesid,$seniorsalespeople,$mobilecode,$whatsappnumber;
    public $fileimport,$iteration,$errormessage,$leadtype=1,$leadkeyword,$lang=0;
    protected $listeners = [ 'taginputevent' => 'taginput'];
    public function taginput(){
        $this->emit('taginput', 1);
    }

    public function updatedMobile($value){
        $this->whatsappnumber=$value;
    }
    public function save(){
        
        $errors=collect();
        try {
            Excel::import(new UsersImport(1),$this->fileimport);
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
        }
    }
    public function rules()
    {
        return [
        'name' => 'required|min:3',
        'email' => 'nullable',
        'mobile' => 'required|unique:users,mobile',
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
      $this->seniorsalespeople= User::where(['department'=>3,'role'=>2,'user_type'=>1])->get();
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
        // $this->langaugesknown='';
        $this->comments='';
        $this->whatsappnumber='';
        $this->leadtype=1;
        $this->leadkeyword='';
    }

    public function update(){
        // dd($this->seniorsalesid);
        $this->validate(); 
        $password=Hash::make($this->mobile);
        $userdata=['name'=>$this->name,'email'=>$this->email,'mobile'=>$this->mobile,
        'whatsappnumber'=>$this->whatsappnumber,'leadtype'=>$this->leadtype,'leadkeyword'=>$this->leadkeyword,
        'mobilecode'=>$this->mobilecode,'password'=>$password,'user_type'=>2,'lang'=>$this->lang];
        $registeruser=User::create($userdata);
        $userdetails=['user_id'=>$registeruser->id,'state'=>$this->state,'refrence'=>$this->reference,'growth'=>$this->growth,'edulevel'=>$this->edulevel,'gender'=>$this->gender,'comments'=>$this->comments];
        $userdetails= UserDetail::create($userdetails);
        $assignedto=auth()->user()->parent_id;
        $leadassignedtosenior= LeadStatus::create(['leadid'=>$registeruser->id,'assignedby'=>0,'assignedto'=>$assignedto,'level'=>2,'leadtype'=>1,'department'=>3,'comments'=>'System Assigned!','is_transferred'=>1]);
        $leadassignedtojunior=LeadStatus::create(['leadid'=>$registeruser->id,'assignedby'=>$assignedto,'assignedto'=>auth()->user()->id,'level'=>3,'leadtype'=>1,'department'=>3,'comments'=>'Lead assigned from senior sales executive to marketing intern']);
        // leadassignedtoseniorsales($assignedto,$registeruser->id);
        leadHistoryMessageSeniorMarketingAssignment($this->mobile,$assignedto,$registeruser->id);
        leadHistoryJuniorMarketingAssignment($assignedto,auth()->user()->id,$registeruser->id);
        WhatsappService::optin($this->mobile);
        WhatsappService::optin($this->whatsappnumber);
        WhatsappService::callmessages($registeruser->id,$this->leadtype,auth()->user()->name,auth()->user()->mobile,$this->lang);
        $this->emit('flashmessage', 'Lead generated successfully');
        $this->resetInputs();
    }
    public function render()
    {
        // $data= User::where('user_type',2)->orderBy('id','desc')->paginate(10);
        $data=LeadStatus::where(['assignedto'=>auth()->user()->id])->orderBy('id','DESC')->paginate(10);
        return view('livewire.sales.juniorcreatelead',compact('data'));
    }
}
