<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsUser
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isUser()) {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have user access');
    }
}

