<?php

declare(strict_types=1);

namespace Tresorkasenda\Contracts;

use Tresorkasenda\Forms\Inputs\Textarea;

trait HasReadOnly
{
    protected bool $readonly = false;

    public function isReadonly(): bool
    {
        return $this->evaluate($this->readonly);
    }

    public function readonly(bool $readonly = true): Textarea
    {
        $this->readonly = $readonly;

        return $this;
    }
}
