<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;

class Login extends Component
{
    public $mobile;
    public $password;
    public $errormessage;
    public $showpass=0;
    public function store()
    {
        
        $mobile = $this->mobile;
        $password = $this->password;
        $fieldType = filter_var($mobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        $attempt = Auth::attempt([$fieldType => $mobile, 'password' => $password,'is_active'=>1]);
        if ($attempt) {
            $department = auth()->user()->department;
            $sub_department = auth()->user()->sub_department;
            $role = auth()->user()->role;
            $usertype=auth()->user()->user_type;
            if ($usertype == 2 ) {
                if(auth()->user()->is_scholorship_user && !auth()->user()->is_transferred){
                    return redirect()->route('scholarship.dashboard');
                }else{
                    return redirect()->route('student.dashboard');
                }
                // $dashboard = (!auth()->user()->is_scholorship_user) ? 'student.dashboard' : 'scholarship.dashboard' ;
            }
            
            switch ($department) {
                case 1:
                    // dd('dd');
                   return redirect()->route('ceo.dashboard');
                    break;
                case 2:
                    return redirect()->route('admin.usermanagement');
                    break;
                case 3:
                    if ($sub_department == null) {
                        return redirect()->back()->with('error',"you have not an authorized access. Please contact to you system admin  !!!");
                        break;
                    }
                    switch ($role) {
                        case 3:
                            if ($sub_department == 2) {
                                return redirect()->route('bde_intern.dashboard');
                            }else {
                                return redirect()->route('bde_junior.dashboard');
                            }
                            break;
                        // return redirect()->route('juniordashboard');
                        default:
                            if ($sub_department == 2) {
                                return redirect()->route('bde_teamLead.dashboard');
                            }else {
                                return redirect()->route('bdm_teamLead.dashboard');
                            }
                            break;
                    }
                    
                    break;
                case 4:
                    switch ($role) {
                        case 3:
                            if ($sub_department == 3) {
                                return redirect()->route('demo_trainer.dashboard');
                            }else {
                                return redirect()->route('class_trainer.dashboard');
                            }
                        break;
                        
                        default:
                            if ($sub_department == 3) {
                                return redirect()->route('demo_manager.dashboard');
                            }else {
                                return redirect()->route('qa_manager.dashboard');
                            }
                        break;
                        
                    }
                break;
                case 5:
                    switch ($role) {
                        case 3:
                            return redirect()->route('content.juniordashboard');
                            break;
                        
                        default:
                            return redirect()->route('content.seniordashboard');
                            break;
                    }
                    break;
                case 6:
                    return redirect()->route('accounts.accountdashboard');
                    break;
                case 7:
                    # code...
                    break;
                default:
                    # code...
                    break;
            }
            return redirect()->route('admin.dashboard');
        } else {
            $this->resetInputs();
            return redirect()->back()->with('error','Invalid email or password !!!');
        }

    }

    public function resetInputs()
    {
        $this->email = '';
        $this->password = '';
    }

    public function showPassword(){
        $this->showpass = 1- $this->showpass;
    }

    public function render()
    {
        return view('website.auth.login')
        ->layout('website.layouts.app');
    }
}
