<?php

namespace App\Http\Middleware;

use App\Exceptions\Main\ForbiddenException;
use Closure;
use Illuminate\Http\Request;

class AuthSimpleUser
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
        if (!$request->user() || !$request->user()->isUser())
            throw new ForbiddenException();

        return $next($request);
    }
}