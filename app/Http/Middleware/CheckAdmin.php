<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        if ($request->user() && $request->user()->hasRole(\App\Role::ROLE_ADMIN)) {
            return $next($request);            
        }

        return redirect('/login');
    }
}
