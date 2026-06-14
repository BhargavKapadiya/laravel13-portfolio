<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Providers\AppServiceProvider;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            if ($request->is(AppServiceProvider::ADMIN_PREFIX) || $request->is(AppServiceProvider::ADMIN_PREFIX . '/*')) {
                return route('admin.login');
            } else {
                return route('login');
            }
        } else {
            return response()->json(['status' => 0, 'message' => trans('auth.Token_invalid'), 'result' => null], 200);
        }
    }
}
