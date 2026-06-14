<?php

use Illuminate\Http\Request;
use App\Http\Middleware\User;
use App\Http\Middleware\Admin;
use App\Http\Middleware\ApiAuthCheck;
use App\Http\Middleware\Authenticate;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Middleware\SecurityHeaders;
use App\Http\Middleware\CheckMaintenance;
use Illuminate\Auth\AuthenticationException;
use App\Http\Middleware\RevalidateBackHistory;
use Illuminate\Session\TokenMismatchException;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        // api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix(AppServiceProvider::ADMIN_PREFIX)
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(
            except: ['stripe/*']
        );

        $middleware->redirectGuestsTo(fn(Request $request) => route('login'));

        $middleware->alias([
            'user' => User::class,
            'admin' => Admin::class,
            'auth' => Authenticate::class,
            'guest' => RedirectIfAuthenticated::class,
            'revalidate' => RevalidateBackHistory::class,
            'secure.headers' => SecurityHeaders::class,
            'check.maintenance' => CheckMaintenance::class,
            'api.auth.check' => ApiAuthCheck::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (HttpException $e, $request) {
            if ($e->getStatusCode() == 419) {
                if ($request->ajax()) {
                    return response()->json(['status' => 419, 'message' => trans('app.your_session_seems_to_have_expired'), 'data' => null], 419);
                } else if ($request->is(AppServiceProvider::ADMIN_PREFIX) || $request->is(AppServiceProvider::ADMIN_PREFIX . '/*')) {
                    return redirect()->route('admin.login')->with('warning', trans('app.your_session_seems_to_have_expired'));
                }
                return redirect()->back()->withInput($request->except('_token'))->withErrors(['warning' => trans('app.your_session_seems_to_have_expired')]);
            }
        });

        $exceptions->render(function (TokenMismatchException $e, Request $request) {
            if ($request->ajax()) {
                return response()->json(['status' => 419, 'message' => trans('app.your_session_seems_to_have_expired'), 'data' => null], 419);
            } else if ($request->is(AppServiceProvider::ADMIN_PREFIX) || $request->is(AppServiceProvider::ADMIN_PREFIX . '/*')) {
                return redirect()->route('admin.login')->with('warning', trans('app.your_session_seems_to_have_expired'));
            }
            return redirect()->route('index')->with('warning', trans('app.your_session_seems_to_have_expired'));
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json(['status' => 404, 'message' => trans('app.Api_not_found'), 'result' => null], 404);
            }
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->expectsJson() && !$request->header('Authorization') !== "") {
                return response()->json(['status' => 401, 'message' => trans('auth.Token_invalid'), 'result' => null], 401);
            }
            if ($request->is(AppServiceProvider::ADMIN_PREFIX) || $request->is(AppServiceProvider::ADMIN_PREFIX . '/*')) {
                return redirect()->guest(route('admin.login'));
            }
            return redirect()->guest(route('login'));
        });
    })
    ->create();
