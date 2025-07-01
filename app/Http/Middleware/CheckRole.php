<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check() && in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses
        return redirect()->route('login')->with('error', 'You do not have permission to access this page.');
    }
}
