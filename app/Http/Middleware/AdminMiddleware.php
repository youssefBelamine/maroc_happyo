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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and is an admin
        // dd(Auth::user()->is_admin);
        if (Auth::hasUser() && Auth::user()->is_admin) {
            // dd("adminMiddleware");
            // dd($next($request));
            return $next($request);
        }
        return redirect('/');
    }
}
