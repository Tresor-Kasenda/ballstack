<?php

declare(strict_types=1);

namespace Tresorkasenda\Facades;

use Illuminate\Support\Facades\Facade;
use Tresorkasenda\Assets\Asset;
use Tresorkasenda\Assets\AssetManager;

/**
 *
 */
class BallStackAsset extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor(): string
    {
        return AssetManager::class;
    }

    /**
     * @param array<Asset> $assets
     */
    public static function register(array $assets, string $package = 'app'): void
    {
        static::resolved(function (AssetManager $assetManager) use ($assets, $package): void {
            $assetManager->register($assets, $package);
        });
    }

    /**
     * @param array<string, mixed> $variables
     */
    public static function registerCssVariables(array $variables, ?string $package = null): void
    {
        static::resolved(function (AssetManager $assetManager) use ($variables, $package): void {
            $assetManager->registerCssVariables($variables, $package);
        });
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function registerScriptData(array $data, ?string $package = null): void
    {
        static::resolved(function (AssetManager $assetManager) use ($data, $package): void {
            $assetManager->registerScriptData($data, $package);
        });
    }
}
