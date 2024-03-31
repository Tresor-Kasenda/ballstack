<?php

declare(strict_types=1);

namespace Tresorkasenda\Component;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Override;
use Throwable;
use Tresorkasenda\Forms\GenericForms;

class Modal extends GenericForms implements Htmlable
{
    public function __construct(
        protected string $name
    ) {
    }

    public static function make(string $name = null): static
    {
        return new static($name);
    }

    public function getName(): ?string
    {
        return $this->evaluate($this->name);
    }

    /**
     * @inheritDoc
     * @throws Throwable
     */
    #[Override]
    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function render(): View
    {
        return view('components.dropdown.modal', $this->extractPublicMethods());
    }
}
