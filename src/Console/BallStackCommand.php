<?php

declare(strict_types=1);

namespace Tresorkasenda\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Pest\TestSuite;
use RuntimeException;
use Symfony\Component\Process\Process;

class BallStackCommand extends Command
{
    protected $signature = 'ballstack:install
                                    {--pest : Indicate that Pest should be installed}
                                    {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    protected $description = 'This is a command for the BallStack package';

    public function handle(): void
    {
        $this->info('✨  This is a command for the BallStack package  ✨');

        $this->info(
            "⚡  update  node package manager.  ⚡ 🎈🎉✨⚡💝💥"
        );

        $this->updateNodePackages(function ($packages) {
            return [
                    'alpinejs' => '^3.4.2',
                ] + $packages;
        });

        $this->info(
            "⚡  update  composer package manager.  ⚡ 🎈🎉✨⚡💝💥"
        );

        // Install Livewire...
        if (!$this->requireComposerPackages([
            'livewire/livewire:^3.4'
        ])) {
            return;
        }

        $this->info(
            "🎉  Copying stubs folders and read content  🎉"
        );

        // Livewire Components...
        (new Filesystem)->ensureDirectoryExists(resource_path('views/livewire'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/views/livewire', resource_path('views/livewire'));

        // Views Components...
        (new Filesystem)->ensureDirectoryExists(resource_path('views/components'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/views/components', resource_path('views/components'));

        // Views Layouts...
        (new Filesystem)->ensureDirectoryExists(resource_path('views/layouts'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/views/layouts', resource_path('views/layouts'));

        // Components...
        (new Filesystem)->ensureDirectoryExists(app_path('View/Composers'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/View/Composers', app_path('View/Composers'));

        // extend composer files to app service Provider
        (new Filesystem)->ensureDirectoryExists(app_path('Providers'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Providers', app_path('Providers'));

        // Actions...
        (new Filesystem)->ensureDirectoryExists(app_path('Livewire'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Livewire', app_path('Livewire'));

        // Public
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/public/js', public_path('assets'));
        //css
        (new Filesystem)->ensureDirectoryExists(resource_path('css'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/css', resource_path('css'));

        // font
        (new Filesystem)->ensureDirectoryExists(resource_path('fonts'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/fonts', resource_path('fonts'));
        $this->line('');
        $this->info(
            "🎉  Installing the pest test and copying stubs  🎉"
        );

        // Tests...
        if (!$this->installTests()) {
            return;
        }

        // Routes...
        copy(__DIR__ . '/../../stubs/routes/web.php', base_path('routes/web.php'));

        // "Dashboard" Route...
        $this->replaceInFile('/home', '/dashboard', resource_path('views/welcome.blade.php'));
        $this->replaceInFile('Home', 'Dashboard', resource_path('views/welcome.blade.php'));

        // Boostrap / Vite...
        copy(__DIR__ . '/../../stubs/vite.config.js', base_path('vite.config.js'));
        copy(__DIR__ . '/../../stubs/resources/css/app.css', resource_path('css/app.css'));
        copy(__DIR__ . '/../../stubs/resources/js/app.js', resource_path('js/app.js'));

        $this->components->info('Installing and building Node dependencies.');

        if (file_exists(base_path('pnpm-lock.yaml'))) {
            $this->runCommands(['pnpm install', 'pnpm run build']);
        } elseif (file_exists(base_path('yarn.lock'))) {
            $this->runCommands(['yarn install', 'yarn run build']);
        } elseif (file_exists(base_path('bun.lock'))) {
            $this->runCommands(['bun install', 'bun run build']);
        } else {
            $this->runCommands(['npm install', 'npm run build']);
        }

        $this->line('');
        $this->components->info('Breeze scaffolding installed successfully.');

    }

    protected static function updateNodePackages(callable $callback, $dev = true): void
    {
        if (!file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
        );
    }

    protected function requireComposerPackages(array $packages, $asDev = false): bool
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = ['php', $composer, 'require'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require'],
            $packages,
            $asDev ? ['--dev'] : [],
        );

        return (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
                ->setTimeout(null)
                ->run(function ($type, $output) {
                    $this->output->write($output);
                }) === 0;
    }

    protected function installTests(): bool
    {
        (new Filesystem)->ensureDirectoryExists(base_path('tests/Feature'));

        if ($this->option('pest') || $this->isUsingPest()) {
            if ($this->hasComposerPackage('phpunit/phpunit')) {
                $this->removeComposerPackages(['phpunit/phpunit'], true);
            }

            if (!$this->requireComposerPackages([
                'pestphp/pest:^2.0',
                'pestphp/pest-plugin-laravel:^2.0'
            ], true)) {
                return false;
            }

            (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/tests/Feature', base_path('tests/Feature'));
            (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/tests/Unit', base_path('tests/Unit'));
            (new Filesystem)->copy(__DIR__ . '/../../stubs/tests/Pest.php', base_path('tests/Pest.php'));
        } else {
            (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/tests/Feature', base_path('tests/Feature'));
        }

        return true;
    }

    protected function isUsingPest(): bool
    {
        return class_exists(TestSuite::class);
    }

    protected function hasComposerPackage($package): bool
    {
        $packages = json_decode(file_get_contents(base_path('composer.json')), true);

        return array_key_exists($package, $packages['require'] ?? [])
            || array_key_exists($package, $packages['require-dev'] ?? []);
    }

    protected function removeComposerPackages(array $packages, $asDev = false): bool
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = ['php', $composer, 'remove'];
        }

        $command = array_merge(
            $command ?? ['composer', 'remove'],
            $packages,
            $asDev ? ['--dev'] : [],
        );

        return (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
                ->setTimeout(null)
                ->run(function ($type, $output) {
                    $this->output->write($output);
                }) === 0;
    }

    protected function replaceInFile($search, $replace, $path): void
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }

    protected function runCommands($commands): void
    {
        $process = Process::fromShellCommandline(implode(' && ', $commands), null, null, null, null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->output->writeln('  <bg=yellow;fg=black> WARN </> ' . $e->getMessage() . PHP_EOL);
            }
        }

        $process->run(function ($type, $line) {
            $this->output->write('    ' . $line);
        });
    }
}
