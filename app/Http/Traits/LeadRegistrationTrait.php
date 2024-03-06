<?php

namespace App\Http\Traits;

use App\Models\User;
use App\Models\LeadStatus;
use App\Models\UserDetail;
use App\Exports\LeadExport;
use App\Models\LeadHistory;
use App\Imports\UsersImport;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ScholarshipLeadExport;
use Maatwebsite\Excel\Validators\ValidationException;

/**
 * Details of specific user
 * 
 * This triat only work in live wire 
 */
trait LeadRegistrationTrait
{ 
    public $editId, $name, $email, $mobile, $reference, $state, $countrycode, $mobilecode, $growth, $edulevel, $gender, $comments, $date, $slot, $errormessage, $haserror;

    public $whatsappnumber,$leadkeyword,$leadtype=0,$lang=0;


    // file import variables 
    public $fileimport,$errormessages=[],$iteration;

    /**
     * Import leads
     */
    public function importSheet() 
    {
        $errors = collect();
        if ($this->fileimport == null) {
            $this->errormessages[]= 'Excel file is empty. Please enter valid excel file';
        }else {

            try {
                Excel::import(new UsersImport(),$this->fileimport);
                $this->fileimport=null;
            } catch (ValidationException $exception) {
                $failures = $exception->failures();
                foreach ($failures as $failure) {
                    $message="You can't import lead on line ". $failure->row() ." ".implode(" ",$failure->errors())."";
                    $errors->push($message);
                }
                $this->errormessages=$errors;
                $this->fileimport=null;
                $this->iteration++;
            }
        }
        if ($this->errormessages == null) {
            $this->emit('flashmessage', 'Lead import successfully');
        }else {
            return $this->errormessages;
            
        }
    }

    /**
     * Export leads 
     */
    public function export()
    {
        $date = date('Ymd-His');
        if (!$this->scholarship_user) {
            return Excel::download(new LeadExport, "Lead-$date.xlsx");
        }else {
            return Excel::download(new ScholarshipLeadExport, "scholarship-$date.xlsx");
        }
    }

    /**
     * Edit method is also use as show method  so don't get confuse
     */
    public function edit($id){
        // $this->emit('taginput', 1);
        $this->editId = $id;
        $editdata = User::findorFail($id);
        $this->name = $editdata->name;
        $this->email = $editdata->email;
        $this->mobilecode = $editdata->mobilecode;
        $this->mobile = $editdata->mobile;

        $this->whatsappnumber = $editdata->whatsappnumber;
        $this->leadkeyword = $editdata->leadkeyword;
        $this->leadtype = $editdata->leadtype;
        $this->lang = $editdata->lang;
        // dd($this->lang);
        $this->state = optional($editdata->userDetails)->state;
        $this->growth = optional($editdata->userDetails)->growth;
        $this->edulevel = optional($editdata->userDetails)->edulevel;
        $this->gender = optional($editdata->userDetails)->gender;
        $this->comments = optional($editdata->userDetails)->comments;
        $this->reference = optional($editdata->userDetails)->refrence;
    }


    public function resetInputsLead(){
        $this->editId = '';
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->whatsappnumber = '';
        $this->countrycode = '';
        $this->state = '';
        $this->reference = '';
        $this->growth = '';
        $this->edulevel = '';
        $this->gender = '';
        $this->comments = '';
        $this->fileimport = '';
        $this->errormessage = '';
        $this->errormessages = [];
        $this->iteration = '';
        $this->leadStartFrom = '';
        $this->assignto = '';
        $this->leadEndTo = '';
        $this->assignDate = '';
        $this->lang = '';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    /**
     * check mobile number on update
     */
    public function updatedMobile(){
        if ($this->editId) {
            $validatedData =  $this->validate([
                'mobile' => 'required|numeric|digits_between:10,13|unique:users,mobile,'."$this->editId,id",
            ]);
        }else {
            $validatedData =  $this->validate([
                'mobile' => 'required|numeric|digits_between:10,13|unique:users,mobile',
            ]);
        }
        // $this->haserror = $validatedData->fails() ? true : false;
    }

    public function updatedEmail()
    {
        if ($this->editId) {
            $validatedData =  $this->validate([
                'email' => 'required|email|string|max:255|unique:users'.",id,".$this->editId,
            ]);
        }else {
            $validatedData =  $this->validate([
                'email' => 'required|email|string|max:255|unique:users,email',
            ]);
        }
        // $this->haserror = $validatedData->fails() ? true : false;
    }

    /**
     * check whatsapp number on update
     */
    public function updatedWhatsappnumber(){
        if ($this->editId) {
            $validatedData =  $this->validate([
                'mobile' => 'required|numeric|digits_between:10,13|unique:users,whatsappnumber,'."$this->editId,id",
            ]);
            
        }else {
            $validatedData =  $this->validate([
                'mobile' => 'required|numeric|digits_between:10,13|unique:users,whatsappnumber',
            ]);
        }
        // $this->haserror = $validatedData->fails() ? true : false;
    }

    /**
     * Create or update lead 
     */
    public function update(){
        $id = $this->editId;
        
        
        $validatedData =  $this->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u|string|min:3|max:50',
            'email' => 'required|email|string|max:255|unique:users'.",id,".$id,
            'mobilecode' => 'required',
            'mobile' => 'required|numeric|digits_between:10,13|unique:users,mobile,'."$id,id",
            'whatsappnumber' => 'required|numeric|digits_between:10,13|unique:users,whatsappnumber,'."$id,id",
            'leadtype' => 'required',
            'state' => 'required',
            'growth' => 'required',
            'edulevel' => 'required',
            'gender' => 'required',
           
        ]);
        $leadty=User::find($id);
        if ($leadty != null && $leadty->leadtype != $this->leadtype) {
            WhatsappService::callmessages($id,$this->leadtype,auth()->user()->name,auth()->user()->mobile,$this->lang);
        }
        $user=['name'=>$this->name,'email'=>$this->email,'mobilecode'=>$this->mobilecode,'mobile'=>$this->mobile,'leadkeyword'=>$this->leadkeyword,'whatsappnumber'=>$this->whatsappnumber,'leadtype'=>$this->leadtype,'lang'=>$this->lang];
        
        
        // if ($this->haserror) {
            if(auth()->user()->department!=2){
                $user['is_transferred']='1';
            }
            $details=['state'=>"$this->state",'refrence'=>"$this->reference",'growth'=>"$this->growth",'edulevel'=>"$this->edulevel",'gender'=>"$this->gender",'comments'=>$this->comments];
            
            if ($id == null) {
            
                $user['user_type']= '2';
                $user['password']= Hash::make($this->mobile);
                
                $registeruser= User::create($user);
                $details['user_id']=$registeruser->id;
                $id=$registeruser->id;
                
                UserDetail::create($details);
    
                $assignedto=auth()->user()->id;
    
                //department id get from sub_department table
                WhatsappService::optin($this->mobile);
                WhatsappService::optin($this->whatsappnumber);
            } else {
                $registeruser= User::findorFail($id)->update($user);
                $details['user_id']=$id;
                $userdetails = UserDetail::where('user_id', $id)->first();
                if ($userdetails) {
                    $userdetails->update($details);
                }else{
                    UserDetail::create($details);
                }
                
                
            }
            $leadstatus = LeadStatus::where(['assignedto'=>auth()->user()->id, 'leadid'=>$id])->first();
            
            if(auth()->user()->department!=2 && !$leadstatus){
                
                LeadStatus::create(['leadid'=>$registeruser->id,'assignedby'=>'0','assignedto'=>$assignedto, 'assign_date'=>date('Y-m-d'), 'level'=>'9','leadtype'=>'1','department'=>auth()->user()->department, 'sub_department'=>auth()->user()->sub_department,'comments'=>'new lead create']);
            }
            if ($leadstatus != null) {
                $leadstatus->update(['leadtype'=>$this->leadtype]);
            }
            
            $this->resetInputsLead();
            $this->statsRefresh();
            $this->emit('flashmessage', 'Lead info updated successfully');
        // }
    }

}
