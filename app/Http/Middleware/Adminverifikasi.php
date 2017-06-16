<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Adminverifikasi
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
        if(Auth::user()->tipe != 3)
        {
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
