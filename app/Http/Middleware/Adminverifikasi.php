<?php

namespace App\Http\Middleware;

use Closure;

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
            abort(403);
        }

        return $next($request);
    }
}
