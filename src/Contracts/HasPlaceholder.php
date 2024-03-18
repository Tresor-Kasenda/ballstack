<?php

declare(strict_types=1);

namespace App\View\TallFlex\Contracts;

trait HasPlaceholder
{
    protected string|null $placeholder = null;

    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function getPlaceholder(): string|null
    {
        return $this->evaluate($this->placeholder) ?? '';
    }
}
