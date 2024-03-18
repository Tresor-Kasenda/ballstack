<?php

declare(strict_types=1);

namespace App\View\TallFlex\Forms\Inputs;

use App\View\TallFlex\Contracts\HasEvaluated;
use App\View\TallFlex\Contracts\HasLabel;
use App\View\TallFlex\Contracts\HasPlaceholder;
use App\View\TallFlex\Contracts\HasRequired;
use App\View\TallFlex\Forms\GenericForms;
use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Throwable;

class NumberSpinner extends GenericForms implements Htmlable
{
    use HasEvaluated;
    use HasLabel;
    use HasPlaceholder;
    use HasRequired;

    protected int|Closure|null $step = null;

    protected int|Closure|null $min = null;

    protected int|Closure|null $max = null;

    protected string $uniqueId;

    public function __construct(
        public string $name
    )
    {
        $this->uniqueId = uniqid('input-' . $this->name, true);
    }

    public static function make(?string $name): static
    {
        return new static($name);
    }

    public function getUniqueId(): string
    {
        return $this->evaluate($this->uniqueId);
    }

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

    public function getName(): string
    {
        return $this->evaluate($this->name);
    }

    /**
     * @throws Throwable
     */
    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function render(): View
    {
        return view('components.forms.number-spinner', $this->extractPublicMethods());
    }
}
