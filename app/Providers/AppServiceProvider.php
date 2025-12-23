<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
 use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
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
    View::share('notifCount', auth()->check()
        ? auth()->user()->unreadNotifications()->count()
        : 0
    );

    View::share('notifications', auth()->check()
        ? auth()->user()->unreadNotifications
        : collect()
    );
}
}
