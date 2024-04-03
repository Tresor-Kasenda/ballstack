<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms;

use Closure;

class Forms extends FormComponent
{
    protected string|Closure|null $action = null;

    protected int|Closure|null $column = 0;

    protected string|null $view = "ballstack::forms.form-builder";

    public function action(string|Closure|null $action): static
    {
        $this->action = $action;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->evaluate($this->action);
    }
}
