<?php

declare(strict_types=1);

namespace Tresorkasenda\Contracts;

trait HasDisabled
{
    protected bool $disabled = false;

    public function isDisabled(): bool
    {
        return $this->evaluate($this->disabled);
    }

    public function disabled(bool $disabled = true): self
    {
        $this->disabled = $disabled;

        return $this;
    }
}
