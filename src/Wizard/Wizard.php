<?php

declare(strict_types=1);

namespace Tresorkasenda\Wizard;

use Closure;
use Illuminate\Support\Facades\Route;
use Tresorkasenda\Forms\Field;

class Wizard extends Field
{
    protected array|Closure|null $steps = [];

    protected Closure|null|Route $route = null;

    protected string $view = "ballstack::forms.wizard";

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
}
