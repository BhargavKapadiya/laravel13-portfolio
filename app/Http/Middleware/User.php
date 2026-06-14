<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \App\Models\User $user */
        $user = Auth::guard('web')->user();
        if ($user) {
            if (in_array($user->getRoleNames()->first(), [USER_ROLE])) {
                if ($user->is_active == 2) {
                    Auth::guard('web')->logout();
                    if ($request->ajax()) {
                        return response()->json(
                            [
                                'status' => false,
                                'message' => trans('auth.Your_account_is_deactivated')
                            ],
                            401
                        );
                    }
                    return redirect()->route('login')->with('warning', trans('auth.Your_account_is_deactivated'));
                } else if ($user->is_complete_profile == 0 && !in_array(Route::currentRouteName(), ['user.complete.profile', 'user.complete.profile.save'])) {
                    return redirect()->route('user.complete.profile');
                }
                return $next($request);
            }
            return redirect()->route('index')->with('warning', trans('auth.Sufficient_permissions'));
        }
        return redirect()->route('index')->with('warning', trans('auth.Account_deleted'));
    }
}
