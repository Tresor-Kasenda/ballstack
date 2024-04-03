<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Tresorkasenda\Contracts\HasFormat;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\Field;

class TimePicker extends Field
{
    use HasFormat;
    use HasLabel;
    use HasPlaceholder;
    use HasRequired;

    protected string|null $minTime = null;

    protected string|null $maxTime = null;

    protected array|null $datalist = [];

    protected string $view = "ballstack::forms.components.time-picker";

    public function minTime(string $minTime): self
    {
        $this->minTime = $minTime;

        return $this;
    }

    public function getMinTime(): string
    {
        return $this->evaluate($this->minTime) ?? '';
    }

    public function maxTime(string $maxTime): self
    {
        $this->maxTime = $maxTime;

        return $this;
    }

    public function getMaxTime(): string
    {
        return $this->evaluate($this->maxTime) ?? '';
    }

    public function datalist(array $datalist): self
    {
        $this->datalist = $datalist;

        return $this;
    }

    public function getDatalist(): array
    {
        return $this->evaluate($this->datalist) ?? [];
    }
}
