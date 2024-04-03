<?php

namespace Tresorkasenda\Contracts;

use Closure;

trait HasDisplayedCard
{
    protected bool|Closure|null $hasCard = false;

    public function isCard(): ?bool
    {
        return $this->evaluate($this->hasCard);
    }

    public function hasCard(bool|Closure|null $hasCard = true): static
    {
        $this->hasCard = $hasCard;

        return $this;
    }
}
