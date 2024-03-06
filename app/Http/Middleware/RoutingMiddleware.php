<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoutingMiddleware
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

        $prefix = $request->route()->getPrefix();
        switch ($prefix) {
            case 'admin':
                if (auth()->user()->department == 2) {
                    return $next($request);
                }else{
                    abort(403);
                }
                break;
            case 'sales':
                if (auth()->user()->department == 3) {
                    return $next($request);
                }else{
                    abort(403);
                }
                break;
            default:
                # code...
                break;
        }
       
    }
}
