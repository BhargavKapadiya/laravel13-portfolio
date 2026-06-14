<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = 'home';
    public const ADMIN_PREFIX = 'admin'; // Admin prefix url

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        define('SUPER_ADMIN_ROLE', 'SuperAdmin');
        define('USER_ROLE', 'User');
        define('ADMIN_GUARD', 'admin'); // Default web guard, if you want to change it

        Paginator::useBootstrapFive();
    }
}
