<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ApiAuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // This middleware used for API only
        $user = null;
        if (Auth::check()) {
            /** @var \App\User @user */
            $user = Auth::user();
            if (!empty($user)) {
                if ($user->is_active == 2) {
                    // Logout user only from current device
                    $user->currentAccessToken()->delete();

                    // Logout user from all devices
                    // $user->tokens()->delete();

                    $user->login_devices()
                        ->update(
                            [
                                'logout_date'  => date('Y-m-d H:i:s'),
                                'is_signout'  => 1
                            ]
                        );
                    return response()->json(['status' => 401, 'message' => trans('auth.Your_account_is_deactivated'), 'result' => null], 401);
                }
            }
        }

        if (empty($user)) {
            return response()->json(['status' => 403, 'message' => trans('auth.User_Deleted'), 'result' => null], 200);
        }

        return $next($request);
    }
}
