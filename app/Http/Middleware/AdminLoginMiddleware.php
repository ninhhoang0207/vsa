<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class AdminLoginMiddleware
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
        $parameter = $request->route()->parameters();
        if (!isset($parameter))
            return Redirect::route('homepage.index');
        if(Auth::check() && (Auth::user()->role=='admin' || Auth::user()->id == $parameter['id'])){
             return $next($request);
         }else{
            return Redirect::route('homepage.index');
         }
       
    }
}
