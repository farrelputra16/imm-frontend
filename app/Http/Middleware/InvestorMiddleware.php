<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
    if (Auth::check()) {
        Log::info('User Role: ' . Auth::user()->role); // Log role user
        if (Auth::user()->role === 'INVESTOR') {
            return $next($request); // Allow access
        }
    }

    return redirect()->route('login')->with('error', 'You do not have access to this page.');
}

}
