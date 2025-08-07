<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('App\Interfaces\AuthInterface', 'App\Services\AuthService');
        $this->app->bind('App\Interfaces\TokenControlInterface', 'App\Services\TokenControlService');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
