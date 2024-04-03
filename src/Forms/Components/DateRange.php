<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Closure;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\Field;

class DateRange extends Field
{
    use HasLabel;
    use HasPlaceholder;
    use HasRequired;

    protected string|Closure|null $minDate = null;

    protected string|Closure|null $maxDate = null;

    protected string $view = "ballstack::forms.components.date-picker";

    public function minDate(string $minDate): self
    {
        $this->minDate = $minDate;

        return $this;
    }

    public function getMinDate(): string
    {
        return $this->evaluate($this->minDate) ?? '';
    }

    public function maxDate(string $maxDate): self
    {
        $this->maxDate = $maxDate;

        return $this;
    }

    public function getMaxDate(): string
    {
        return $this->evaluate($this->maxDate) ?? '';
    }
}
