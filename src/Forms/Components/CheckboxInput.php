<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Tresorkasenda\Contracts\HasChecked;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\Field;

class CheckboxInput extends Field
{
    use HasChecked;
    use HasLabel;
    use HasRequired;

    protected string|null $tooltip = null;

    protected string $view = "ballstack::forms.components.checkbox";

    public function tooltip(string $tooltip): static
    {
        $this->tooltip = $tooltip;
        return $this;
    }

    public function getTooltip(): string|null
    {
        return $this->evaluate($this->tooltip);
    }
}
