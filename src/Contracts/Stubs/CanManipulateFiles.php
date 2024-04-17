<?php

namespace Tresorkasenda\Contracts\Stubs;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use function Laravel\Prompts\confirm;

trait CanManipulateFiles
{
    protected function copyStub(string $stub, string $targetPath, array $replacements = []): void
    {
        $filesystem = app(Filesystem::class);

        if (!$this->fileExists($stubPath = File::get(__DIR__ . "/../../../stubs/{$stub}.stub"))) {
            $stubPath = $this->getDefaultStubPath() . "/{$stub}.stub";
        }

        $stub = str($filesystem->get($stubPath));

        foreach ($replacements as $key => $replacement) {
            $stub = $stub->replace("{{ {$key} }}", $replacement);
        }

        $stub = (string)$stub;

        $this->writeFile($targetPath, $stub);
    }

    protected function fileExists(string $path): bool
    {
        $filesystem = app(Filesystem::class);

        return $filesystem->exists($path);
    }

    protected function getDefaultStubPath(): string
    {
        $reflectionClass = new ReflectionClass($this);

        return (string)str($reflectionClass->getFileName())
            ->beforeLast('Commands')
            ->beforeLast('Console')
            ->beforeLast('src')
            ->append('stubs');
    }

    protected function writeFile(string $path, string $contents): void
    {
        $filesystem = app(Filesystem::class);

        $filesystem->ensureDirectoryExists(
            pathinfo($path, PATHINFO_DIRNAME),
        );

        $filesystem->put($path, $contents);
    }

    protected function getContent(string $path): string
    {
        $filesystem = app(Filesystem::class);

        return $filesystem->get($path);
    }

    private function checkIfComponentExists(array $paths): bool
    {
        $pathsCollection = collect($paths);

        $existingPaths = $pathsCollection->filter(fn($path) => $this->fileExists($path));

        if ($existingPaths->isNotEmpty()) {
            $confirm = $existingPaths->map(fn($path) => basename($path))->implode(', ');

            if (!confirm("$confirm already exists, do you want to overwrite it?")) {
                $this->components->error("{$existingPaths->implode(', ')} already exists, aborting.");
                return true;
            }

            $existingPaths->each(fn($path) => unlink($path));
        }

        return false;
    }
}
