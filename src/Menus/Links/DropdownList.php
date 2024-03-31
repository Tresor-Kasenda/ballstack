<?php

declare(strict_types=1);

namespace Tresorkasenda\Menus\Links;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;
use Illuminate\View\View;
use Throwable;
use Tresorkasenda\Contracts\HasExtractPublicMethods;

class DropdownList extends Component implements Htmlable
{
    use HasExtractPublicMethods;

    public function __construct(
        protected ?string $name
    ) {
    }

    public static function make(?string $name): static
    {
        return new static($name);
    }

    /**
     * @throws Throwable
     */
    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function render(): View
    {
        return view('ballstack::dropdown.dropdown', $this->extractPublicMethods());
    }
}
