<?php

declare(strict_types=1);

namespace Tresorkasenda\Contracts;

use Livewire\Component;

trait BelongsToParent
{
    protected ?Component $parentComponent = null;

    public function parentComponent(Component $component): static
    {
        $this->parentComponent = $component;

        return $this;
    }

    public function getParentComponent(): ?Component
    {
        return $this->parentComponent;
    }

    public function isRoot(): bool
    {
        return null === $this->parentComponent;
    }
}
