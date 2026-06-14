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
        if (ADMIN_GUARD == "web" && Auth::guard(ADMIN_GUARD)->user()->role_id != SUPER_ADMIN_ROLE) {
            return redirect()->route('index')->with('warning', trans('auth.Sufficient_permissions'));
        }

        return $next($request);
    }
}
