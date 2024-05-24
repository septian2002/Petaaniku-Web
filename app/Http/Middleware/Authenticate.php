<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    // public function handle($request, Closure $next, ...$guards)
    // {
    //     $this->authenticate($request, $guards);

    //     // Check user level after authentication
    //     if (Auth::check() && Auth::user()->level === 'admin') {
    //         return redirect('/dashboard'); // Redirect admin to dashboard
    //     }

    //     return $next($request);
    // }
}
