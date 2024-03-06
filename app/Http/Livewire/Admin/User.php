<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Department;
use App\Imports\StaffImport;
use Livewire\WithPagination;
use App\Models\SubDepartment;
use Livewire\WithFileUploads;
use App\Mail\GeneratePassword;
use App\Services\ActionsService;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\NewUserRegisteration;
use Maatwebsite\Excel\Validators\ValidationException;


class User extends Component
{   
    use WithPagination, WithFileUploads;

    // search and pagination of table
    public $search, $paginate=10;

    // cards users 
    public $total_sales, $total_trainings, $total_content, $total_hr, $total_finance, $activeDepartment=3;

    // staff create model variables 
    public $edit_id, $name, $email, $mobilecode, $mobile, $department=0, $sub_department, $role, $job_type, $senior;

    public $senior_data=[] , $junior_data=[], $junior_ids=[],$junior_assignids=[];

    protected $listeners = ['editon' => 'edit','reset' => 'resetInputs'];

    // file import variables 
    public $fileimport,$errormessages=[],$iteration;
    
    public $pageheading="Employees";

    // get all seniors deatils when updating role 
    public function updatedRole(){
        if ($this->role == '3') {
            $query = UserModel::query();
            $query = $query->where(['user_type'=>'1', 'role'=>'2','department'=> $this->department]);
            if ($this->sub_department) {
                $query = $query->where('sub_department',$this->sub_department);
            }
            $this->senior_data = $query->get();
        }
    }


    // get all juniors details when updating department
    public function updatedDepartment(){
        $this->senior_data = UserModel::where(['user_type'=>'1', 'role'=>'2','department'=> $this->department])->get();
        
        $this->junior_data = UserModel::where(['user_type'=>'1', 'role'=>'3','department'=> $this->department, 'parent_id'=>'0'])->get();     
        $this->sub_department = ''; 
    }
    
    // if user update sub department then update seniors and juniors data 
    public function updatedSubDepartment(){
        $this->senior_data = UserModel::where(['user_type'=>'1', 'role'=>'2','department'=> $this->department,'sub_department' => $this->sub_department])->get();

        $this->junior_data = UserModel::where(['user_type'=>'1', 'role'=>'3','department'=> $this->department,'sub_department' => $this->sub_department, 'parent_id'=>'0'])->get();
    }


    /**
     * Import leads
     */
    public function importSheet() 
    {
       // dd('call');
        $errors = collect();
        if ($this->fileimport == null) {
            $this->errormessages[]= 'Excel file is empty. Please enter valid excel file';
        }else {

            try {
                Excel::import(new StaffImport(),$this->fileimport);
                $this->fileimport=null;
            } catch (ValidationException $exception) {
                $failures = $exception->failures();
              //  dd($failures);
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
            
            $this->emit('flashmessage', 'Staff import successfully');
        }else {
            return $this->errormessages;
            
        }
    }



    /**
     * change users on click
     * 
     * @param int department_id
     * @return int department 
     */
    public function changeActiveDepartment($department){
        $this->activeDepartment = $department;
    } 

    public function recountUsers()
    {
        $this->total_sales = UserModel::where(['user_type'=>'1', 'department'=>'3'])->count();
        $this->total_trainings = UserModel::where(['user_type'=>'1', 'department'=>'4'])->count();
        $this->total_content = UserModel::where(['user_type'=>'1', 'department'=>'5'])->count();
        $this->total_finance = UserModel::where(['user_type'=>'1', 'department'=>'6'])->count();
        $this->total_hr = UserModel::where(['user_type'=>'1', 'department'=>'7'])->count();
    }
 
    public function mount(){
        $this->recountUsers();
    }

    public function resetInputsLead()
    {
        $this->resetInputs();
    }

    public function resetInputs(){
        $this->edit_id = '';
        $this->name = '';
        $this->email = '';
        $this->mobilecode = '';
        $this->mobile = '';
        $this->department = 0;
        $this->sub_department = '';
        $this->role = '';
        $this->job_type = '';
        $this->senior = '';
    }

    public function edit($id){
        $data= UserModel::findorFail($id);
        $this->edit_id=$id;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->mobilecode = $data->mobilecode;
        $this->mobile = $data->mobile;
        $this->department = $data->department;
        $this->sub_department = $data->sub_department;
        $this->role = $data->role;
        $this->job_type = $data->job_type;
        $this->senior = $data->parent_id;
        $this->senior_data = UserModel::where(['user_type'=>'1', 'role'=>'2','department'=> $this->department,'sub_department'=> $this->sub_department])->get();

    }

    /**
     * update user status
     * 
     * @param int userid
     * @param int user_status
     * @return response
     */
    public function changestatus($id, $status){
        $status = 1-$status;
        $data= UserModel::findorFail($id)->update(['is_active' => $status]);
        $this->emit('flashmessage', 'Status changed successfully');
    }

    /**
     * create or update user 
     */
    public function store(){
     //  dd($this->edit_id);
        if($this->senior && $this->sub_department)
        {
            $this->validate([
            'department' => 'required',
            'senior' => 'required',
        ]);
        }
        else
        {
        $this->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:30',
            'email' => 'required|email|unique:users,email,' . $this->edit_id,
            'role' => 'nullable',
            'mobile' => 'required|digits:10|unique:users,mobile,' . $this->edit_id,
            'department' => 'required',
            'mobilecode' => 'required',
        ]);
        }
      ////  dd("call");
        $password=Hash::make($this->mobile);

        $data=['name'=>$this->name ?? '','role'=>$this->role ?? 0,'email'=>$this->email ?? '','mobile'=>$this->mobile ?? '','department'=>$this->department,'mobilecode'=>$this->mobilecode ?? '','job_type'=>$this->job_type ?? '0'];
        
        if ($this->sub_department) {
            $data['sub_department'] = (int)$this->sub_department;
        }
        if ($this->senior) {
            $data['parent_id'] = $this->senior;
        }
        if (!$this->edit_id) {
            $data['password']=$password;
        }
        $url=route('login');
         if($this->email)
         {
        Mail::to($this->email)->send(new GeneratePassword($this->email,$this->mobile,$url));
         }
         if($this->junior_assignids)
         {
            foreach ($this->junior_assignids as $key => $value) {
            UserModel::findorFail($value)->update(['parent_id'=>$this->senior]);
             }
         ////  $createuser= !$this->edit_id ? UserModel::create($data) : UserModel::findorFail($this->edit_id)->update($data);

         }
         else
         {
           $createuser= !$this->edit_id ? UserModel::create($data) : UserModel::findorFail($this->edit_id)->update($data);
           $departmentname=Department::find($this->department)->name;

           if (!$this->edit_id) {
               ActionsService::newuserregister($createuser->id);
           }
         }
        
       
        // newregisterationmessages($createuser->id,$this->name,$departmentname);
        $status = $this->edit_id ? "Create" : "Update";
        $this->resetInputs();
        $this->recountUsers();
        $this->emit('flashmessage',"User $status Successfully!");
    }

    /**
     * assign juniors under senior
     * 
     */
    public function assigStaff()
    {
       // dd("call");
        $this->validate([
            'department' => 'required',
            'senior' => 'required',
            'junior_ids' => 'required',
        ]);
        foreach ($junior_ids as $key => $value) {
            UserModel::findorFail($value)->update(['parent_id'=>$this->senior]);
        }

        $this->resetInputs();
        $this->emit('flashmessage','User Created Successfully!');
    }


    public function render(){
        $query = UserModel::query();
        
        $query->where(['user_type'=>'1', 'department'=> $this->activeDepartment]);
        if ($this->search) {
            $query = $query->where('name', 'LIKE', "%{$this->search}%")->orWhere('email', 'LIKE', "%{$this->search}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
        }
        $data = $query->orderBy('id','desc')->paginate($this->paginate);
        
        return view('livewire.admin.user',['users'=>$data])->layout('layouts.new-app', ['pageheading' => $this->pageheading]);
    }
}
