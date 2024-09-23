<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvestorMiddleware
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
        // Check if the user is logged in and if their role is 'INVESTOR'
        if (Auth::check() && Auth::user()->role === 'INVESTOR') {
            return $next($request); // Allow access
        }

        // Redirect guests and non-investors to the login page or an unauthorized page
        return redirect()->route('login')->with('error', 'You do not have access to this page.');
    }
}
