<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SuperadminCheck
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!(isset(Auth::user()->is_superadmin) && Auth::user()->is_superadmin)) {
            return Redirect::back();
        }
        return $next($request);
    }
}
