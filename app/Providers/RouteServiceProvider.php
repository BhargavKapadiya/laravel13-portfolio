<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->routes(function () {

            // Web routes
            Route::middleware('web')->group(base_path('routes/web.php'));

            // Admin routes — prefix + extra middleware
            Route::middleware(['web', 'auth', 'admin'])->prefix('admin')->name('admin.')->group(base_path('routes/admin.php'));
        });
    }
}
