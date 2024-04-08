<?php

declare(strict_types=1);

namespace Tresorkasenda\Contracts;

use Closure;

trait HasColumns
{
    protected int|Closure|null $column = 0;

    public function column(int|Closure|null $column): static
    {
        $this->column = $column;

        return $this;
    }

    public function getColumn(): ?int
    {
        return $this->evaluate($this->column);
    }
}
