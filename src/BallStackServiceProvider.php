<?php

declare(strict_types=1);

namespace Tresorkasenda;

use Illuminate\Support\ServiceProvider;
use Tresorkasenda\Console\BallStackCommand;
use Tresorkasenda\View\Composers\LayoutComposer;
use Tresorkasenda\View\Composers\SideBarLayout;

class BallStackServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->viewConfig();

        view()->composer('layouts.guest', LayoutComposer::class);
        view()->composer('layouts.guest', SideBarLayout::class);

        $this->mergeConfigFrom(__DIR__ . '/../config/ballstack.php', 'ballstack');
    }

    protected function viewConfig(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ballstack');
        if ($this->app->runningInConsole()) {
            $this->commands([
                BallStackCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../config/ballstack.php' => config_path('ballstack.php'),
        ]);
    }

    public function register(): void
    {

    }
}
