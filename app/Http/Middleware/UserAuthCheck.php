<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuthCheck
{
    public function handle($request, Closure $next)
    {
        if (!(Auth::user())) {
            return redirect('/auth/vkontakte');
        }
        return $next($request);
    }
}