<?php

namespace Tresorkasenda\BallStack\Component;

use App\View\TallFlex\Forms\GenericForms;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Override;
use Throwable;

class Dropdown extends GenericForms implements Htmlable
{

    public function __construct(
        protected string $name
    )
    {
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
        return view('components.dropdown.dropdown', $this->extractPublicMethods());
    }
}
