<?php

declare(strict_types=1);

namespace Tresorkasenda\BallStack;

use Illuminate\Support\ServiceProvider;
use Tresorkasenda\BallStack\Console\BallStackCommand;
use Tresorkasenda\BallStack\View\Composers\LayoutComposer;
use Tresorkasenda\BallStack\View\Composers\SideBarLayout;

class BallStackServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ballstack');
        if ($this->app->runningInConsole()) {
            $this->commands([
                BallStackCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../config/ballstack.php' => config_path('ballstack.php'),
        ]);

        view()->composer('layouts.guest', LayoutComposer::class);
        view()->composer('layouts.guest', SideBarLayout::class);

        $this->mergeConfigFrom(__DIR__ . '/../config/ballstack.php', 'ballstack');
    }

    public function register()
    {

    }
}
