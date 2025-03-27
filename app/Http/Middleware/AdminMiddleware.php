<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function __construct()
    {
        logger("AdminMiddleware loaded");
    }

    public function handle(Request $request, Closure $next)
    {
        // Use Spatie's "hasRole" method
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }
        abort(403, 'Unauthorized access.');
    }
    
}
