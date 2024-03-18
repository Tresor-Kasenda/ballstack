<?php

declare(strict_types=1);

namespace App\View\TallFlex\Forms\Inputs;

use App\View\TallFlex\Contracts\HasEvaluated;
use App\View\TallFlex\Contracts\HasFormat;
use App\View\TallFlex\Contracts\HasLabel;
use App\View\TallFlex\Contracts\HasPlaceholder;
use App\View\TallFlex\Contracts\HasRequired;
use App\View\TallFlex\Forms\GenericForms;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Throwable;

class TimePicker extends GenericForms implements Htmlable
{
    use HasEvaluated;
    use HasFormat;
    use HasLabel;
    use HasPlaceholder;
    use HasRequired;

    protected string|null $minTime = null;

    protected string|null $maxTime = null;

    protected array|null $datalist = [];

    public function __construct(
        public string $name,
    )
    {
    }

    public static function make(?string $name): self
    {
        return new self($name);
    }

    public function getName(): string
    {
        return $this->evaluate($this->name);
    }

    /**
     * @inheritDoc
     * @throws Throwable
     */
    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function render(): View
    {
        return view('components.forms.time-picker', $this->extractPublicMethods());
    }

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
