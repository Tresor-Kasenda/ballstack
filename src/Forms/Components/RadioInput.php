<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Tresorkasenda\Contracts\HasChecked;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\Field;

class RadioInput extends Field
{
    use HasChecked;
    use HasLabel;
    use HasRequired;

    protected array $options = [];

    protected bool $inline = false;

    protected string $view = "ballstack::forms.components.radio";

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
}
