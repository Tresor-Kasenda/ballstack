<?php

namespace Tresorkasenda\BallStack\Wizard;

use App\View\TallFlex\Forms\GenericForms;
use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Override;
use Throwable;

class Wizard extends GenericForms implements Htmlable
{
    protected array|Closure|null $steps = [];

    protected Closure|null|Route $route = null;

    public function __construct(
        protected ?string $name
    )
    {
    }

    public static function make(?string $name = null): static
    {
        return new static($name);
    }

    public function getName(): ?string
    {
        return $this->evaluate($this->name);
    }

    public function steps(array|Closure|null $steps): self
    {
        $this->steps = $steps;

        return $this;
    }

    public function getSteps(): ?array
    {
        return $this->evaluate($this->steps);
    }

    public function submit(Route|Closure|null $route): self
    {
        $this->route = $route;

        return $this;
    }

    public function getSubmit()
    {
        return $this->evaluate($this->route);
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
        return view('components.forms.wizard', $this->extractPublicMethods());
    }
}
