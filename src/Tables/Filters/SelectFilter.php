<?php

declare(strict_types=1);

namespace Tresorkasenda\Tables\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Select Filter
 *
 * Filter with predefined options in a select dropdown.
 *
 * @package Tresorkasenda\Tables\Filters
 */
class SelectFilter extends Filter
{
    /**
     * Available options for the select.
     *
     * @var array
     */
    protected array $options = [];

    /**
     * Placeholder text.
     *
     * @var string|null
     */
    protected ?string $placeholder = null;

    /**
     * Whether the filter supports multiple selections.
     *
     * @var bool
     */
    protected bool $multiple = false;

    /**
     * Set the options for the select.
     *
     * @param array $options
     * @return static
     */
    public function options(array $options): static
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Get the options.
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Set the placeholder text.
     *
     * @param string $placeholder
     * @return static
     */
    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * Get the placeholder.
     *
     * @return string|null
     */
    public function getPlaceholder(): ?string
    {
        return $this->placeholder ?? __('Select...');
    }

    /**
     * Enable multiple selection.
     *
     * @param bool $multiple
     * @return static
     */
    public function multiple(bool $multiple = true): static
    {
        $this->multiple = $multiple;
        return $this;
    }

    /**
     * Check if multiple selection is enabled.
     *
     * @return bool
     */
    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    /**
     * {@inheritDoc}
     */
    protected function applyFilter(Builder $query, mixed $value): Builder
    {
        if (empty($value)) {
            return $query;
        }

        $column = $this->getColumn();

        if ($this->multiple && is_array($value)) {
            return $query->whereIn($column, $value);
        }

        return $query->where($column, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getView(): string
    {
        return 'ballstack::datatable.filters.select';
    }

    /**
     * {@inheritDoc}
     */
    public function getViewData(): array
    {
        return [
            'options' => $this->getOptions(),
            'placeholder' => $this->getPlaceholder(),
            'multiple' => $this->isMultiple(),
        ];
    }
}
