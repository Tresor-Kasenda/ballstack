<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Closure;
use Tresorkasenda\Contracts\HasDisabled;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasLivewire;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\Field;

/**
 * Tags Input Component
 *
 * Provides a tag input field with features:
 * - Dynamic tag addition
 * - Autocompletion from suggestions
 * - Maximum tags limit
 * - Custom separator
 * - Tag validation
 * - Duplicate prevention
 *
 * @package Tresorkasenda\Forms\Components
 */
class TagsInput extends Field
{
    use HasDisabled;
    use HasLabel;
    use HasLivewire;
    use HasPlaceholder;
    use HasRequired;

    /**
     * Suggested tags for autocompletion.
     *
     * @var array
     */
    protected array $suggestions = [];

    /**
     * Maximum number of tags allowed.
     *
     * @var int|null
     */
    protected int|null $maxTags = null;

    /**
     * Separator character for tags.
     *
     * @var string
     */
    protected string $separator = ',';

    /**
     * Allow duplicate tags.
     *
     * @var bool
     */
    protected bool $allowDuplicates = false;

    /**
     * Trim whitespace from tags.
     *
     * @var bool
     */
    protected bool $trimTags = true;

    /**
     * Dropdown configuration for suggestions.
     *
     * @var bool
     */
    protected bool $dropdown = true;

    /**
     * Enforce whitelist (only allow suggested tags).
     *
     * @var bool
     */
    protected bool $enforceWhitelist = false;

    /**
     * Minimum characters to show dropdown.
     *
     * @var int
     */
    protected int $minChars = 1;

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
    protected string $view = "ballstack::forms.components.tags-input";

    /**
     * Set suggestions for autocompletion.
     *
     * @param array|Closure $suggestions
     * @return static
     */
    public function suggestions(array|Closure $suggestions): static
    {
        $this->suggestions = $suggestions instanceof Closure ? $suggestions() : $suggestions;
        return $this;
    }

    /**
     * Get the suggestions.
     *
     * @return array
     */
    public function getSuggestions(): array
    {
        return $this->suggestions;
    }

    /**
     * Set the maximum number of tags.
     *
     * @param int|null $maxTags
     * @return static
     */
    public function maxTags(?int $maxTags): static
    {
        $this->maxTags = $maxTags;
        return $this;
    }

    /**
     * Get the maximum number of tags.
     *
     * @return int|null
     */
    public function getMaxTags(): ?int
    {
        return $this->maxTags;
    }

    /**
     * Set the separator character.
     *
     * @param string $separator
     * @return static
     */
    public function separator(string $separator): static
    {
        $this->separator = $separator;
        return $this;
    }

    /**
     * Get the separator.
     *
     * @return string
     */
    public function getSeparator(): string
    {
        return $this->separator;
    }

    /**
     * Allow duplicate tags.
     *
     * @param bool $allow
     * @return static
     */
    public function allowDuplicates(bool $allow = true): static
    {
        $this->allowDuplicates = $allow;
        return $this;
    }

    /**
     * Check if duplicates are allowed.
     *
     * @return bool
     */
    public function getDuplicates(): bool
    {
        return $this->allowDuplicates;
    }

    /**
     * Enable/disable tag trimming.
     *
     * @param bool $trim
     * @return static
     */
    public function trimTags(bool $trim = true): static
    {
        $this->trimTags = $trim;
        return $this;
    }

    /**
     * Check if tags should be trimmed.
     *
     * @return bool
     */
    public function shouldTrimTags(): bool
    {
        return $this->trimTags;
    }

    /**
     * Enable/disable dropdown for suggestions.
     *
     * @param bool $dropdown
     * @return static
     */
    public function dropdown(bool $dropdown = true): static
    {
        $this->dropdown = $dropdown;
        return $this;
    }

    /**
     * Check if dropdown is enabled.
     *
     * @return bool
     */
    public function hasDropdown(): bool
    {
        return $this->dropdown;
    }

    /**
     * Enforce whitelist (only allow suggested tags).
     *
     * @param bool $enforce
     * @return static
     */
    public function enforceWhitelist(bool $enforce = true): static
    {
        $this->enforceWhitelist = $enforce;
        return $this;
    }

    /**
     * Check if whitelist is enforced.
     *
     * @return bool
     */
    public function isWhitelistEnforced(): bool
    {
        return $this->enforceWhitelist;
    }

    /**
     * Set minimum characters to show dropdown.
     *
     * @param int $minChars
     * @return static
     */
    public function minChars(int $minChars): static
    {
        $this->minChars = $minChars;
        return $this;
    }

    /**
     * Get minimum characters.
     *
     * @return int
     */
    public function getMinChars(): int
    {
        return $this->minChars;
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
