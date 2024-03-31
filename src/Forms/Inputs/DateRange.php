<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Inputs;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Override;
use Throwable;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\GenericForms;

use function view;

class DateRange extends GenericForms implements Htmlable
{
    use HasEvaluated;
    use HasLabel;
    use HasPlaceholder;
    use HasRequired;

    protected string|Closure|null $minDate = null;

    protected string|Closure|null $maxDate = null;

    public function __construct(
        protected string $name
    ) {
    }

    public static function make(?string $name): static
    {
        return new  static($name);
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
        return view('components.forms.date-range', $this->extractPublicMethods());
    }
}
