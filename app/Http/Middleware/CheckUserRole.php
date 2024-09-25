<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            // User is not logged in
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }

        if (Auth::user()->role !== strtoupper($role)) {
            // User does not have the correct role
            // Return a 403 Forbidden response with a custom view or message
            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}
