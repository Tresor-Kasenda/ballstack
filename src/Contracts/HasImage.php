<?php

declare(strict_types=1);

namespace Tresorkasenda\Contracts;

use Closure;

trait HasImage
{
    protected string|Closure|null $image = null;

    public function image(string|Closure|null $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getImage(): Closure|string|null
    {
        return $this->evaluate($this->image);
    }
}
