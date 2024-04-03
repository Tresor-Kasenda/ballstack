<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Closure;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\Field;

class NumberSpinner extends Field
{
    use HasLabel;
    use HasPlaceholder;
    use HasRequired;

    protected int|Closure|null $step = null;

    protected int|Closure|null $min = null;

    protected int|Closure|null $max = null;

    protected string $uniqueId;

    protected string $view = "ballstack::forms.components.number-spinner";

    public function getMin(): int|Closure|null
    {
        return $this->min;
    }

    public function min(int|Closure|null $min): NumberSpinner
    {
        $this->min = $min;
        return $this;
    }

    public function getMax(): int|Closure|null
    {
        return $this->max;
    }

    public function max(int|Closure|null $max): NumberSpinner
    {
        $this->max = $max;
        return $this;
    }

    public function getStep(): int|Closure|null
    {
        return $this->step;
    }

    public function step(int|Closure|null $step): NumberSpinner
    {
        $this->step = $step;
        return $this;
    }
}
