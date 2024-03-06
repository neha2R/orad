<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::guard($guard)->check()){
            $department = auth()->user()->department;
            $sub_department = auth()->user()->sub_department;
            $role = auth()->user()->role;
            $usertype=auth()->user()->user_type;
            if ($usertype == 2 ) {
               return redirect('/student/dashboard');
            }
            switch ($department) {
                case 1:
                   return redirect('/ceo/dashboard');
                    break;
                case 2:
                    return redirect('/admin/usermanagement');
                    break;
                case 3:
                    switch ($role) {
                        case 3:
                            if ($sub_department == 2) {
                                return redirect('/bde_junior/dashboard');
                            }else {
                                return redirect('/bde_intern/dashboard');
                            }
                            break;
                        // return redirect('/juniordashboard');
                        default:
                            if ($sub_department == 2) {
                                return redirect('/bde_teamLead/dashboard');
                            }else {
                                return redirect('/bdm_teamLead/dashboard');
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
                            return redirect('/content/juniordashboard');
                            break;
                        
                        default:
                            return redirect('/content/seniordashboard');
                            break;
                    }
                    break;
                case 6:
                    return redirect('/accounts/accountdashboard');
                    break;
                case 7:
                    # code...
                    break;
                default:
                    # code...
                    break;
            }
            
        }
        return $next($request);
    }
}
