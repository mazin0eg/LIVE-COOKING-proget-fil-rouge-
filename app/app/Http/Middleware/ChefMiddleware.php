<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChefMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'chef') {
            if (Auth::check() && Auth::user()->role === 'cooker') {
                return redirect()->route('contact')->with('info', 'You need to be approved as a chef to add recipes. Please apply through the contact form.');
            }
            
            return redirect()->route('show.login')->with('error', 'You must be logged in as a chef to access this page.');
        }

        return $next($request);
    }
}
