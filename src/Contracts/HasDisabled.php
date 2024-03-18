<?php

declare(strict_types=1);

namespace App\View\TallFlex\Contracts;

use App\View\TallFlex\Forms\Inputs\Textarea;

trait HasDisabled
{
    protected bool $disabled = false;

    public function isDisabled(): bool
    {
        return $this->evaluate($this->disabled);
    }

    public function disabled(bool $disabled = true): Textarea
    {
        $this->disabled = $disabled;

        return $this;
    }
}
