<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms;

use Livewire\Component;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasExtractPublicMethods;

abstract class GenericForms extends Component
{
    use HasEvaluated;
    use HasExtractPublicMethods;

    abstract public static function make(?string $name): static;
}
