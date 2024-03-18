<?php

declare(strict_types=1);

namespace App\View\TallFlex\Forms\Inputs;

use App\View\TallFlex\Contracts\HasChecked;
use App\View\TallFlex\Contracts\HasEvaluated;
use App\View\TallFlex\Contracts\HasLabel;
use App\View\TallFlex\Contracts\HasRequired;
use App\View\TallFlex\Forms\GenericForms;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Throwable;

class RadioInput extends GenericForms implements Htmlable
{
    use HasChecked;
    use HasEvaluated;
    use HasLabel;
    use HasRequired;

    protected array $options = [];

    protected bool $inline = false;

    public function __construct(
        public string $name
    ) {
    }

    public static function make(string $name): static
    {
        return new static($name);
    }

    public function inline(): static
    {
        $this->inline = true;
        return $this;
    }

    public function isInline(): bool
    {
        return $this->evaluate($this->inline);
    }

    public function getName()
    {
        return $this->evaluate($this->name);
    }

    public function boolean(): static
    {
        $this->options = ['Yes', 'No'];

        return $this;
    }

    public function options(array $options): static
    {
        $this->options = $options;
        return $this;
    }

    public function getOptions(): array
    {
        return $this->evaluate($this->options);
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
        return view('components.forms.radio', $this->extractPublicMethods());
    }
}
