<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class VerifyGoogle2fa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { 
        
    if (Auth::check() && Auth::user()->hasCompletedGoogle2fa()) {

        return redirect()->route('vendor.dashboard');
    }else{
       
        return redirect('/vendor/check');
    }
   
    // // return redirect('/vendor/vendor_2fa');
    // return redirect()->route('/login');
    // return $next($request);
    
       
    }
}
