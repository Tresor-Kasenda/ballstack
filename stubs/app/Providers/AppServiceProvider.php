<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View\Composers\LayoutComposer;
use View\Composers\SideBarLayout;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('layouts.guest', LayoutComposer::class);
        view()->composer('layouts.guest', SideBarLayout::class);
    }
}
