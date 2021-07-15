<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        $allowed = false;
        $default_guard = config('auth.defaults.guard');
        $guards = empty($guards)?[$default_guard]:$guards;

        foreach($guards as $guard)
        {
            if(auth()->guard($guard)->check()) {
                $allowed = true;
                break;
            }
        }

        if(!$allowed)
        {
            \Alert::error('Access Restricted!')->flash();
            return redirect()->route('home');
        }

        return $next($request);
    }
}
