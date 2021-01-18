<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role_p)
    {
        if(!$request->user()->UserHasRole($role_p)){
            abort(403, "NOT AUTHORIZED NIGGA | ONLY ".$role_p." ALLOWED");
        }

        return $next($request);
    }
}
