<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Closure;
use Illuminate\Support\Collection;
use Tresorkasenda\Contracts\HasDisabled;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasLivewire;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\Field;

/**
 * MultiSelect Component
 *
 * Provides a multi-select dropdown with advanced features:
 * - Real-time search
 * - Grouped options
 * - Tag display for selected items
 * - Maximum items limit
 * - Taggable (allow custom values)
 *
 * @package Tresorkasenda\Forms\Components
 */
class MultiSelectInput extends Field
{
    use HasDisabled;
    use HasLabel;
    use HasLivewire;
    use HasPlaceholder;
    use HasRequired;

    /**
     * The available options for the select.
     *
     * @var array|Collection
     */
    protected array|Collection $options = [];

    /**
     * Whether the select is searchable.
     *
     * @var bool
     */
    protected bool $searchable = false;

    /**
     * Maximum number of items that can be selected.
     *
     * @var int|null
     */
    protected int|null $maxItems = null;

    /**
     * Whether users can add custom tags.
     *
     * @var bool
     */
    protected bool $taggable = false;

    /**
     * Whether options are grouped.
     *
     * @var bool
     */
    protected bool $grouped = false;

    /**
     * Close dropdown after selecting an item.
     *
     * @var bool
     */
    protected bool $closeOnSelect = false;

    /**
     * Remove button for each selected item.
     *
     * @var bool
     */
    protected bool $removeButton = true;

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
    protected string $view = "ballstack::forms.components.multi-select";

    /**
     * Set the options for the select.
     *
     * @param array|Collection|Closure $options
     * @return static
     */
    public function options(array|Collection|Closure $options): static
    {
        $this->options = $options instanceof Closure ? $options() : $options;
        return $this;
    }

    /**
     * Get the options for the select.
     *
     * @return array|Collection
     */
    public function getOptions(): array|Collection
    {
        return $this->options;
    }

    /**
     * Make the select searchable.
     *
     * @param bool $searchable
     * @return static
     */
    public function searchable(bool $searchable = true): static
    {
        $this->searchable = $searchable;
        return $this;
    }

    /**
     * Check if the select is searchable.
     *
     * @return bool
     */
    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    /**
     * Set the maximum number of items that can be selected.
     *
     * @param int|null $maxItems
     * @return static
     */
    public function maxItems(?int $maxItems): static
    {
        $this->maxItems = $maxItems;
        return $this;
    }

    /**
     * Get the maximum number of items.
     *
     * @return int|null
     */
    public function getMaxItems(): ?int
    {
        return $this->maxItems;
    }

    /**
     * Allow users to add custom tags.
     *
     * @param bool $taggable
     * @return static
     */
    public function taggable(bool $taggable = true): static
    {
        $this->taggable = $taggable;
        return $this;
    }

    /**
     * Check if the select is taggable.
     *
     * @return bool
     */
    public function isTaggable(): bool
    {
        return $this->taggable;
    }

    /**
     * Mark options as grouped.
     *
     * @param bool $grouped
     * @return static
     */
    public function grouped(bool $grouped = true): static
    {
        $this->grouped = $grouped;
        return $this;
    }

    /**
     * Check if options are grouped.
     *
     * @return bool
     */
    public function isGrouped(): bool
    {
        return $this->grouped;
    }

    /**
     * Close dropdown after selecting an item.
     *
     * @param bool $closeOnSelect
     * @return static
     */
    public function closeOnSelect(bool $closeOnSelect = true): static
    {
        $this->closeOnSelect = $closeOnSelect;
        return $this;
    }

    /**
     * Check if dropdown closes on select.
     *
     * @return bool
     */
    public function shouldCloseOnSelect(): bool
    {
        return $this->closeOnSelect;
    }

    /**
     * Show/hide remove button for each selected item.
     *
     * @param bool $removeButton
     * @return static
     */
    public function removeButton(bool $removeButton = true): static
    {
        $this->removeButton = $removeButton;
        return $this;
    }

    /**
     * Check if remove button should be shown.
     *
     * @return bool
     */
    public function hasRemoveButton(): bool
    {
        return $this->removeButton;
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
