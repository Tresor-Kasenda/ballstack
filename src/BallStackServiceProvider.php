<?php

declare(strict_types=1);

namespace Tresorkasenda;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Tresorkasenda\Assets\AssetManager;
use Tresorkasenda\Console\BallStackCommand;
use Tresorkasenda\Facades\BallStackAsset;

class BallStackServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->viewConfig();

        $this->configureComponents();

        $this->mergeConfigFrom(__DIR__ . '/../config/ballstack.php', 'ballstack');
    }

    protected function viewConfig(): void
    {
        BallStackAsset::register([

        ], 'tresorkasenda/ballstack');

        Blade::directive('ballStackScripts', function (string $expression): string {
            return "<?php echo \Tresorkasenda\Facades\BallStackAsset::renderScripts({$expression}) ?>";
        });

        Blade::directive('ballStackStyles', function (string $expression): string {
            return "<?php echo \Tresorkasenda\Facades\BallStackAsset::renderStyles({$expression}) ?>";
        });

        Blade::extend(function ($view) {
            return preg_replace('/\s*@trim\s*/m', '', $view);
        });

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
        $this->app->scoped(AssetManager::class, fn() => new AssetManager());
    }

    protected function configureComponents(): void
    {
        $prefix = config('ballstack.prefix');

        Blade::component($prefix . 'logo-guest', 'logo-guest');
    }
}
