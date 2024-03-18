<?php

declare(strict_types=1);

namespace App\View\TallFlex\Contracts;

use Closure;
use Livewire\Component;

trait HasEvaluated
{
    protected Component $livewire;

    public function evaluate(mixed $value)
    {
        if ($value instanceof Closure) {
            return app()->call($value, [
                'state' => $this->livewire->{$this->getName()},
            ]);
        }
        return $value;
    }
}
