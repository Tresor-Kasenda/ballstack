<?php

namespace Tresorkasenda\Facades;

use Illuminate\Support\Facades\Facade;
use Tresorkasenda\Assets\AssetManager;

/**
 *
 */
class BallStackAsset extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return AssetManager::class;
    }

    /**
     * @param array<Asset> $assets
     */
    public static function register(array $assets, string $package = 'app'): void
    {
        static::resolved(function (AssetManager $assetManager) use ($assets, $package) {
            $assetManager->register($assets, $package);
        });
    }

    /**
     * @param array<string, mixed> $variables
     */
    public static function registerCssVariables(array $variables, ?string $package = null): void
    {
        static::resolved(function (AssetManager $assetManager) use ($variables, $package) {
            $assetManager->registerCssVariables($variables, $package);
        });
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function registerScriptData(array $data, ?string $package = null): void
    {
        static::resolved(function (AssetManager $assetManager) use ($data, $package) {
            $assetManager->registerScriptData($data, $package);
        });
    }
}
