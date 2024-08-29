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
        if (! Auth::check()) {
            // code...
            return redirect()->route('login');
        }

        $userRoles = Auth::user()->role;
        if ($userRoles == 1) {
            // code...
            return $next($request);
        }
        if ($userRoles == 2) {
            // code...
            return redirect()->route('user.dashboard');
        }
    }
}
