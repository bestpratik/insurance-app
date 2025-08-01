<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         if (!Auth::check()) {
            return redirect()->route('login'); 
        }

        if (Auth::user()->type === 'user') {
            return redirect()->route('login')->with('error', 'Access denied.');
        }

        return $next($request);
        
        // if (Auth::check() && Auth::user()->type !== 'user') {
        //     return $next($request);
        // }
        // abort(403, 'Unauthorized access.');
    }
}
