<?php

declare(strict_types=1);

namespace Tresorkasenda\Contracts;

use Closure;

trait HasIcons
{
    protected string|Closure|null $icon;

    public function icon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->evaluate($this->icon);
    }
}
