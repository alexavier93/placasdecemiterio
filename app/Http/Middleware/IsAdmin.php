<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class IsAdmin
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
        if (FacadesAuth::user() &&  FacadesAuth::user()->is_admin == 1) {
             return $next($request);
        }

        return redirect('admin')->with('error','You have not admin access');
    }
}