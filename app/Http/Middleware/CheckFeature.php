<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckFeature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (User::hasFeature($role, $request->user())) {
            return $next($request);
        }
        return response(['message' => 'Você não tem permissão para executar essa função'], 401);
    }
}
