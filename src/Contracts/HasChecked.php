<?php

declare(strict_types=1);

namespace Tresorkasenda\Contracts;

trait HasChecked
{
    protected bool $checked = false;

    public function checked(bool $checked = true): static
    {
        $this->checked = $checked;
        return $this;
    }

    public function getChecked()
    {
        return $this->evaluate($this->checked);
    }
}
