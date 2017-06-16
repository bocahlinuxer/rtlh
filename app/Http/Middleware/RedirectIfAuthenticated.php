<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->tipe == 1)
            {
                return redirect('/superadmin/');
            } 
            elseif(Auth::user()->tipe == 2)
            {
                return redirect('/adminperbekel/');
            }
            elseif(Auth::user()->tipe == 3)
            {
                return redirect('/adminverifikasi/');
            }
            elseif(Auth::user()->tipe == 4)
            {
                return redirect('/adminkepala/');
            }
        }

        return $next($request);
    }
}
