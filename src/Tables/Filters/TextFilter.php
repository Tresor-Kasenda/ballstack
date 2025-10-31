<?php

declare(strict_types=1);

namespace Tresorkasenda\Tables\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Text Filter
 *
 * Filter for text-based searches with LIKE operator.
 *
 * @package Tresorkasenda\Tables\Filters
 */
class TextFilter extends Filter
{
    /**
     * Placeholder text for the input.
     *
     * @var string|null
     */
    protected ?string $placeholder = null;

    /**
     * Search operator (like, =, !=, etc.).
     *
     * @var string
     */
    protected string $operator = 'like';

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
        return $this->placeholder ?? __('Search...');
    }

    /**
     * Set the search operator.
     *
     * @param string $operator
     * @return static
     */
    public function operator(string $operator): static
    {
        $this->operator = $operator;
        return $this;
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

        if ($this->operator === 'like') {
            return $query->where($column, 'like', "%{$value}%");
        }

        return $query->where($column, $this->operator, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getView(): string
    {
        return 'ballstack::datatable.filters.text';
    }

    /**
     * {@inheritDoc}
     */
    public function getViewData(): array
    {
        return [
            'placeholder' => $this->getPlaceholder(),
        ];
    }
}
