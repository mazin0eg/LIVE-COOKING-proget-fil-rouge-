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
        
        if (!Auth::check()) {
            return redirect()->route('show.login')->with('message', 'Veuillez vous connecter pour accéder à cette page');
        }
    
        
        if (Auth::user()->role !== 'chef') {
            return redirect()->route('contact')->with('message', 'Seuls les chefs peuvent accéder à cette page');
        }
    
        return $next($request);
    }
}
