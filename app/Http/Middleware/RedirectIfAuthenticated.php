<?php

namespace App\Http\Middleware;

use App\Providers\AppServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if ($guard == ADMIN_GUARD && Auth::guard($guard)->check() && ($request->is(AppServiceProvider::ADMIN_PREFIX) || $request->is(AppServiceProvider::ADMIN_PREFIX . '/*'))) {
                return redirect(AppServiceProvider::ADMIN_PREFIX);
            } else if ($guard == ADMIN_GUARD && Auth::guard($guard)->check()) {
                return redirect(AppServiceProvider::ADMIN_PREFIX);
            }
            if ($guard == "web" && Auth::guard($guard)->check()) {
                return redirect(AppServiceProvider::HOME);
            }
            if (Auth::guard($guard)->check()) {
                return redirect(AppServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
