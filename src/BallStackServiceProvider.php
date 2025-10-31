<?php

declare(strict_types=1);

namespace Tresorkasenda;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Tresorkasenda\Assets\AssetManager;
use Tresorkasenda\Console\Commands\BallStackInstallCommand;
use Tresorkasenda\Console\Commands\MakeFormCommand;
use Tresorkasenda\Console\Commands\MakeUserCommand;
use Tresorkasenda\Console\Commands\MakeDatatableCommand;
use Tresorkasenda\Facades\BallStackAsset;
use Livewire\Livewire;

class BallStackServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->viewConfig();

        $this->configureComponents();

        $this->registerLivewireComponents();

        $this->loadHelpers();

        $this->mergeConfigFrom(__DIR__ . '/../config/ballstack.php', 'ballstack');
    }

    protected function viewConfig(): void
    {
        BallStackAsset::register([

        ], 'tresorkasenda/ballstack');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ballstack');

        $this->publishes([
            __DIR__ . '/../config/ballstack.php' => config_path('ballstack.php'),
        ]);

        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                BallStackInstallCommand::class,
                MakeFormCommand::class,
                MakeUserCommand::class,
                MakeDatatableCommand::class,
            ]);
        }
    }

    public function register(): void
    {
        $this->app->scoped(AssetManager::class, fn() => new AssetManager());
    }

    protected function configureComponents(): void
    {
        $prefix = config('ballstack.prefix');

        Blade::component($prefix . 'logo-guest', 'logo-guest');
    }

    /**
     * Register Livewire components.
     *
     * @return void
     */
    protected function registerLivewireComponents(): void
    {
        Livewire::component('ballstack::toast-manager', \Tresorkasenda\Notifications\ToastManager::class);
    }

    /**
     * Load helper functions.
     *
     * @return void
     */
    protected function loadHelpers(): void
    {
        if (file_exists($file = __DIR__ . '/Helpers/toast.php')) {
            require_once $file;
        }
    }
}
