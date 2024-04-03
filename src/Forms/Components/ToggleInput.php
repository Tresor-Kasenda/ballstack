<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Tresorkasenda\Contracts\HasChecked;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\Field;

class ToggleInput extends Field
{
    use HasChecked;
    use HasLabel;
    use HasRequired;

    protected string $view = "ballstack::forms.components.toggle";
}
