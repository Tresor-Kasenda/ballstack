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
 * Rating Input Component
 *
 * Provides a star rating input with features:
 * - Configurable number of stars
 * - Half-star support
 * - Different icon types (stars, hearts, etc.)
 * - Custom colors
 * - Read-only mode
 * - Hover effects
 *
 * @package Tresorkasenda\Forms\Components
 */
class RatingInput extends Field
{
    use HasDisabled;
    use HasLabel;
    use HasLivewire;
    use HasRequired;

    /**
     * Number of stars/icons.
     *
     * @var int
     */
    protected int $stars = 5;

    /**
     * Allow half-star ratings.
     *
     * @var bool
     */
    protected bool $allowHalf = false;

    /**
     * Read-only mode (display only).
     *
     * @var bool
     */
    protected bool $readOnly = false;

    /**
     * Icon type (star, heart, etc.).
     *
     * @var string
     */
    protected string $icon = 'star';

    /**
     * Color for filled icons.
     *
     * @var string
     */
    protected string $color = 'warning';

    /**
     * Size of the icons (sm, md, lg).
     *
     * @var string
     */
    protected string $size = 'md';

    /**
     * Show numeric value next to stars.
     *
     * @var bool
     */
    protected bool $showValue = false;

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
    protected string $view = "ballstack::forms.components.rating-input";

    /**
     * Set the number of stars.
     *
     * @param int $stars
     * @return static
     */
    public function stars(int $stars): static
    {
        $this->stars = $stars;
        return $this;
    }

    /**
     * Get the number of stars.
     *
     * @return int
     */
    public function getStars(): int
    {
        return $this->stars;
    }

    /**
     * Allow half-star ratings.
     *
     * @param bool $allow
     * @return static
     */
    public function allowHalf(bool $allow = true): static
    {
        $this->allowHalf = $allow;
        return $this;
    }

    /**
     * Check if half-stars are allowed.
     *
     * @return bool
     */
    public function isHalfAllowed(): bool
    {
        return $this->allowHalf;
    }

    /**
     * Set read-only mode.
     *
     * @param bool $readOnly
     * @return static
     */
    public function readOnly(bool $readOnly = true): static
    {
        $this->readOnly = $readOnly;
        return $this;
    }

    /**
     * Check if component is read-only.
     *
     * @return bool
     */
    public function isReadOnly(): bool
    {
        return $this->readOnly;
    }

    /**
     * Set the icon type.
     *
     * @param string $icon star|heart|thumb
     * @return static
     */
    public function icon(string $icon): static
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * Get the icon type.
     *
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * Set the color.
     *
     * @param string $color primary|warning|danger|success|info
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
     * Set the size.
     *
     * @param string $size sm|md|lg
     * @return static
     */
    public function size(string $size): static
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Get the size.
     *
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * Show numeric value next to stars.
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
