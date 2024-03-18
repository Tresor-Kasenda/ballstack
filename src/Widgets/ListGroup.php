<?php

namespace App\View\TallFlex\Widgets;

use App\View\TallFlex\Contracts\HasEvaluated;
use App\View\TallFlex\Contracts\HasExtractPublicMethods;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Livewire\Component;
use Override;
use Throwable;

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
        return view('components.widgets.list-group', $this->extractPublicMethods());
    }
}
