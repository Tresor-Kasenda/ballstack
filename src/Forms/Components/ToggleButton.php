<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Closure;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\Field;

/**
 * Class AdvancedControl
 *
 * The AdvancedControl class extends the FormComponent class and implements the Htmlable interface.
 * It provides methods for creating and managing advanced form controls.
 *
 * @package App\View\TallFlex\Forms\Inputs
 */
class ToggleButton extends Field
{
    use HasLabel;
    use HasRequired;

    protected string|Closure|null $mode = null;

    protected array|Closure|null $icons = [];

    protected Closure|string|null $description = null;

    protected Closure|bool $disabled = false;

    protected array|Closure|null $options = [];

    protected string $view = "ballstack::forms.components.toggle";

    private Closure|bool $multiple = false;

    public function mode(string|Closure|null $mode): static
    {
        $this->mode = $mode;

        return $this;
    }

    public function getMode(): string|null
    {
        return $this->evaluate($this->mode);
    }

    public function icons(array|Closure|null $icons): static
    {
        $this->icons = $icons;

        return $this;
    }

    public function getIcons(): array
    {
        return $this->evaluate($this->icons);
    }

    public function description(string|Closure|null $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function multiple(bool|Closure $multiple = true): static
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function isMultiple(): bool
    {
        return $this->evaluate($this->multiple);
    }

    public function getDescription(): string
    {
        return $this->evaluate($this->description);
    }

    public function disabled(bool|Closure $disabled = true): static
    {
        $this->disabled = $disabled;

        return $this;
    }

    public function isDisabled(): bool
    {
        return $this->evaluate($this->disabled);
    }

    public function options(array|Closure|null $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): array|Closure|null
    {
        return $this->evaluate($this->options);
    }
}
