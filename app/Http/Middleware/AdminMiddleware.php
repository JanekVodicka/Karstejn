<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in and has the admin role
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        
        // Return to login if not logged in or not an 'admin' user
        return redirect('login')->with('error', 'Přístup odmítnut. Pouze pro admin uživatele');
    }
}
