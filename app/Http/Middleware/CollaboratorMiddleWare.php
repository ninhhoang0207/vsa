<?php

namespace App\Http\Middleware;

use Closure, Auth, Redirect;

class CollaboratorMiddleWare
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
        if (Auth::check() && Auth::user()->role != 'user')
            return $next($request);
        return Redirect::route('homepage.index');
    }
}
