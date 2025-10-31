<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Closure;
use Tresorkasenda\Contracts\HasDisabled;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasLivewire;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\Field;

/**
 * Slider Input Component
 *
 * Provides a slider/range input with features:
 * - Single value or range (min/max)
 * - Custom min/max values
 * - Step increments
 * - Prefix/suffix for display
 * - Value display
 * - Tooltips
 *
 * @package Tresorkasenda\Forms\Components
 */
class SliderInput extends Field
{
    use HasDisabled;
    use HasLabel;
    use HasLivewire;
    use HasRequired;

    /**
     * Minimum value.
     *
     * @var float
     */
    protected float $min = 0;

    /**
     * Maximum value.
     *
     * @var float
     */
    protected float $max = 100;

    /**
     * Step increment.
     *
     * @var float
     */
    protected float $step = 1;

    /**
     * Prefix for display value (e.g., $, €).
     *
     * @var string|null
     */
    protected ?string $prefix = null;

    /**
     * Suffix for display value (e.g., kg, km).
     *
     * @var string|null
     */
    protected ?string $suffix = null;

    /**
     * Show value above/below slider.
     *
     * @var bool
     */
    protected bool $showValue = true;

    /**
     * Enable range mode (two handles).
     *
     * @var bool
     */
    protected bool $range = false;

    /**
     * Show tooltips on handles.
     *
     * @var bool
     */
    protected bool $tooltips = true;

    /**
     * Orientation (horizontal or vertical).
     *
     * @var string
     */
    protected string $orientation = 'horizontal';

    /**
     * Color of the slider track.
     *
     * @var string
     */
    protected string $color = 'primary';

    /**
     * Help text to display below the field.
     *
     * @var string|Closure|null
     */
    protected string|Closure|null $helpText = null;

    /**
     * The view for this component.
     *
     * @var string
     */
    protected string $view = "ballstack::forms.components.slider-input";

    /**
     * Set the minimum value.
     *
     * @param float $min
     * @return static
     */
    public function min(float $min): static
    {
        $this->min = $min;
        return $this;
    }

    /**
     * Get the minimum value.
     *
     * @return float
     */
    public function getMin(): float
    {
        return $this->min;
    }

    /**
     * Set the maximum value.
     *
     * @param float $max
     * @return static
     */
    public function max(float $max): static
    {
        $this->max = $max;
        return $this;
    }

    /**
     * Get the maximum value.
     *
     * @return float
     */
    public function getMax(): float
    {
        return $this->max;
    }

    /**
     * Set the step increment.
     *
     * @param float $step
     * @return static
     */
    public function step(float $step): static
    {
        $this->step = $step;
        return $this;
    }

    /**
     * Get the step increment.
     *
     * @return float
     */
    public function getStep(): float
    {
        return $this->step;
    }

    /**
     * Set the prefix for display.
     *
     * @param string|null $prefix
     * @return static
     */
    public function prefix(?string $prefix): static
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * Get the prefix.
     *
     * @return string|null
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * Set the suffix for display.
     *
     * @param string|null $suffix
     * @return static
     */
    public function suffix(?string $suffix): static
    {
        $this->suffix = $suffix;
        return $this;
    }

    /**
     * Get the suffix.
     *
     * @return string|null
     */
    public function getSuffix(): ?string
    {
        return $this->suffix;
    }

    /**
     * Show/hide value display.
     *
     * @param bool $show
     * @return static
     */
    public function showValue(bool $show = true): static
    {
        $this->showValue = $show;
        return $this;
    }

    /**
     * Check if value should be shown.
     *
     * @return bool
     */
    public function shouldShowValue(): bool
    {
        return $this->showValue;
    }

    /**
     * Enable range mode (two handles).
     *
     * @param bool $range
     * @return static
     */
    public function range(bool $range = true): static
    {
        $this->range = $range;
        return $this;
    }

    /**
     * Check if range mode is enabled.
     *
     * @return bool
     */
    public function isRange(): bool
    {
        return $this->range;
    }

    /**
     * Show/hide tooltips on handles.
     *
     * @param bool $tooltips
     * @return static
     */
    public function tooltips(bool $tooltips = true): static
    {
        $this->tooltips = $tooltips;
        return $this;
    }

    /**
     * Check if tooltips should be shown.
     *
     * @return bool
     */
    public function hasTooltips(): bool
    {
        return $this->tooltips;
    }

    /**
     * Set the orientation.
     *
     * @param string $orientation horizontal|vertical
     * @return static
     */
    public function orientation(string $orientation): static
    {
        $this->orientation = $orientation;
        return $this;
    }

    /**
     * Get the orientation.
     *
     * @return string
     */
    public function getOrientation(): string
    {
        return $this->orientation;
    }

    /**
     * Set the color.
     *
     * @param string $color primary|success|warning|danger|info
     * @return static
     */
    public function color(string $color): static
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Get the color.
     *
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Set help text for the field.
     *
     * @param string|Closure $text
     * @return static
     */
    public function helpText(string|Closure $text): static
    {
        $this->helpText = $text;
        return $this;
    }

    /**
     * Get the help text.
     *
     * @return string|null
     */
    public function getHelpText(): ?string
    {
        if ($this->helpText instanceof Closure) {
            return $this->evaluate($this->helpText);
        }
        return $this->helpText;
    }
}
