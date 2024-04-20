<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
      
        foreach ($guards as $guard) {
            
            // if (Auth::guard($guard)->check()) {
            //     return redirect(RouteServiceProvider::HOME);
            // }
              if ($guard == 'admin' && Auth::guard($guard)->check()) {
                return redirect()->route('admin.dashboard');
              }

              if ($guard == 'vendor' && Auth::guard($guard)->check()) {
              
                return redirect()->route('vendor.event_management.event');
                // return redirect()->route('vendor.event_management.event');
                // return redirect('/vendor_2fa');
              }
        
              if ($guard == 'web' && Auth::guard($guard)->check()) {
                // return redirect()->route('user.dashboard');
                    return redirect(RouteServiceProvider::HOME);
              }
              
            //   if ($guard == 'organizer' && Auth::guard($guard)->check()) {
            //     return redirect()->route('organizer.dashboard');
            //   }

        }

        return $next($request);
    }
}
