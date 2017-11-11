<?php

namespace App\Http\Middleware;

use Closure;

class CheckFeature extends Middleware
{
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->hasRole($role)) {
        }

        return $next($request);
    }

}
