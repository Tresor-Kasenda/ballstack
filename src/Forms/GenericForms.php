<?php

declare(strict_types=1);

namespace App\View\TallFlex\Forms;

use App\View\TallFlex\Contracts\HasEvaluated;
use App\View\TallFlex\Contracts\HasExtractPublicMethods;
use Livewire\Component;

abstract class GenericForms extends Component
{
    use HasExtractPublicMethods;
    use HasEvaluated;

    abstract public static function make(?string $name): static;
}
