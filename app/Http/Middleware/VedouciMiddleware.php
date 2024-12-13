<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VedouciMiddleware
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
        // Check if the user is logged in and has the vedouci role
        if (Auth::check() && Auth::user()->role === 'vedouci') {
            // Allow access to settings
            if ($request->is('prihlasky-private')) {
                return redirect('settings')->with('error-login-role', 'Přístup odmítnut. Pouze pro admin uživatele');
            }

            // Allow access to all other views
            return $next($request); 
        }
        
        // Return to login if not logged in or not a 'vedouci' user
        return redirect('login')->with('error-login-role', 'Přístup odmítnut. Pouze pro admin uživatele');
    }
}
