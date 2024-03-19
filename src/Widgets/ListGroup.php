<?php

declare(strict_types=1);

namespace Tresorkasenda\Widgets;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Livewire\Component;
use Override;
use Throwable;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasExtractPublicMethods;

class ListGroup extends Component implements Htmlable
{
    use HasEvaluated;
    use HasExtractPublicMethods;

    public function __construct(
        protected string $name
    )
    {
    }

    public static function mame(string $name = null): static
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
        return view('ballstack::widgets.list-group', $this->extractPublicMethods());
    }
}
