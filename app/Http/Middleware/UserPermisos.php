<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Route;

class UserPermisos
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
        if (leerJson(Auth::user()->permisos, Route::currentRouteName()) == true || Auth::user()->role == 100){
            return $next($request);
        }else{
            return redirect()->route('dashboard');
        }

    }
}
