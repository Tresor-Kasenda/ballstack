<?php

namespace Tresorkasenda\Ballstack;

use Illuminate\Support\ServiceProvider;
use Tresorkasenda\BallStackServiceProvider;
use Tresorkasenda\BaseComponent;
use function app;

class Ballstack extends BaseComponent
{
    public static function getPanel(): string|ServiceProvider
    {
        return app()->register(BallStackServiceProvider::class);
    }
}
