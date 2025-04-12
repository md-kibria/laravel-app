<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has either 'admin' or 'super' role
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'super')) {
            return $next($request); // Allow the request to proceed
        }

        // Redirect if the user does not have the required role
        return redirect('/')->with('error', 'You do not have admin access');
    }
}