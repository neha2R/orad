<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessDevelopmentExecutiveTeamLead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && auth()->user()->department == '3' && auth()->user()->sub_department == '2'  && auth()->user()->role == '2'){
            
            return $next($request);
        }else{
            return redirect('/login');
        }
    }
}
