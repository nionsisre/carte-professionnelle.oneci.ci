<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Closure;

class IsConneted
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next)
    {
        //verification
        if (Route::currentRouteName()== "login" || Route::currentRouteName()== "authentificaton"
        ) {
            return $next($request);
        }
        if(Auth::check()){
            return $next($request);
        }else{
            return redirect()->route("login");
        }

    }
}
