<?php

declare(strict_types=1);

namespace Tresorkasenda\Assets;

use Composer\InstalledVersions;
use Throwable;

abstract class Asset
{
    protected string $id;

    protected bool $isLoadedOnRequest = false;

    protected string $package;

    protected ?string $path = null;

    final public function __construct(string $id, ?string $path = null)
    {
        $this->id = $id;
        $this->path = $path;
    }

    public static function make(string $id, ?string $path = null): static
    {
        return app(static::class, ['id' => $id, 'path' => $path]);
    }

    public function loadedOnRequest(bool $condition = true): static
    {
        $this->isLoadedOnRequest = $condition;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function package(string $package): static
    {
        $this->package = $package;

        return $this;
    }

    public function isRemote(): bool
    {
        return str($this->getPath())->startsWith(['http://', 'https://', '//']);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getVersion(): string
    {
        try {
            return InstalledVersions::getVersion($this->getPackage());
        } catch (Throwable $exception) {
            return InstalledVersions::getVersion('tresorkasenda/ballstack');
        }
    }

    public function getPackage(): string
    {
        return $this->package;
    }

    public function isLoadedOnRequest(): bool
    {
        return $this->isLoadedOnRequest;
    }

    abstract public function getPublicPath(): string;
}
