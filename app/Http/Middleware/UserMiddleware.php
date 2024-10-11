<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
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
        // Check if the user is logged in and if their role is 'USER'
        if (Auth::check() && Auth::user()->role === 'USER') {
            return $next($request); // Allow access for 'USER'
        }

        // Return a 403 Forbidden response for any non 'USER' role
        return abort(403, 'Unauthorized action.');
    }
}
