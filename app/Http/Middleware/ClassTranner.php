<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTranner
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
        if(Auth::check() && auth()->user()->department == '4' && auth()->user()->sub_department == '4'  && auth()->user()->role == '3'){
            
            return $next($request);
        }else{
            return redirect('/login');
        }
    }
}
