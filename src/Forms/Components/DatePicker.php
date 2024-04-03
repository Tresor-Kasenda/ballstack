<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Tresorkasenda\Contracts\HasFormat;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\Field;

class DatePicker extends Field
{
    use HasFormat;
    use HasLabel;
    use HasPlaceholder;
    use HasRequired;

    protected string|null $minDate = null;

    protected string|null $maxDate = null;

    protected bool $enableTime = false;

    protected bool $multiple = false;

    protected string|null $mode = null;

    protected array|null $disable = [];

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

    public function enableTime(bool $enableTime = true): self
    {
        $this->enableTime = $enableTime;

        return $this;
    }

    public function mode(string|null $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function getMode(): string
    {
        return $this->evaluate($this->mode) ?? '';
    }

    public function getEnableTime(): bool
    {
        return $this->evaluate($this->enableTime);
    }

    public function disable(array $dates): self
    {
        $this->disable = $dates;

        return $this;
    }

    public function getDisable(): array
    {
        return $this->evaluate($this->disable) ?? [];
    }
}
