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
use Override;
use Throwable;

class DatePicker extends GenericForms implements Htmlable
{
    use HasEvaluated;
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

    public function __construct(
        protected string $name,
    )
    {
    }

    public static function make(?string $name): static
    {
        return new self($name);
    }

    public function getName(): string
    {
        return $this->evaluate($this->name);
    }

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

    /**
     * @inheritDoc
     * @throws Throwable
     */
    #[Override]
    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function render(): View
    {
        return view('components.forms.date-picker', $this->extractPublicMethods());
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
