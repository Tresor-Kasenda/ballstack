<?php

declare(strict_types=1);

namespace Tresorkasenda\Contracts;

use Closure;

trait HasLabel
{
    protected string|Closure|null $label = null;

    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel()
    {
        return $this->evaluate($this->label ?? null) ??
            (string)str($this->getName())
                ->afterLast('.')
                ->kebab()
                ->replace(['-', '_'], ' ')
                ->ucfirst();
    }
}
