<?php

declare(strict_types=1);

namespace App\View\TallFlex\Contracts;

use Closure;

trait HasRequired
{
    protected bool|Closure $required = false;


    public function required(bool|Closure $condition = true): self
    {
        $this->required = $condition;

        return $this;
    }

    public function getRequired(): bool
    {
        return (bool)$this->evaluate($this->required);
    }
}
