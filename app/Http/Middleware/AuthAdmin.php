<?php

namespace App\Http\Middleware;

use App\Exceptions\Main\ForbiddenException;
use Closure;
use Illuminate\Http\Request;

class AuthAdmin
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
        if (!$request->user() || !$request->user()->isAdmin())
            return redirect()->route('admin_login');

        return $next($request);
    }
}