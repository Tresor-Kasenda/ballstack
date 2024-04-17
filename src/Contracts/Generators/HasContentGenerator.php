<?php

namespace Tresorkasenda\Contracts\Generators;

use Illuminate\Support\Facades\Artisan;
use function Laravel\Prompts\confirm;

trait HasContentGenerator
{
    public function canCreateModel(string $model): void
    {
        if (confirm("Do you want to create a new model named {$model}?")) {
            Artisan::call('make:model', [
                'name' => $model,
                '-m' => true,
                '-s' => true,
                '-f' => true,
            ]);

            return;
        }
    }
}
