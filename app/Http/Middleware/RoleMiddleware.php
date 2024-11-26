<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
   
    public function handle($request, Closure $next, $role)
    {
        if (auth()->user()->role !== $role) {
            return redirect()->route('home')->with('error', 'Unauthorized.');
        }
    
        return $next($request);
    }
}
