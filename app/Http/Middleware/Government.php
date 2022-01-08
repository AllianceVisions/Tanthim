<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Government
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->user_type == 'companiesAndInstitution'){ 
            return redirect()->route('company.home');
        }elseif(Auth::user()->user_type == 'client'){ 
            return redirect()->route('client.home');
        }elseif(Auth::user()->user_type == 'staff'){ 
            return redirect()->route('admin.home');
        }
        return $next($request);
    }
}
