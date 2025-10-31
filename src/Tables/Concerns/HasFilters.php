<?php

declare(strict_types=1);

namespace Tresorkasenda\Tables\Concerns;

use Tresorkasenda\Tables\Filters\Filter;

/**
 * Has Filters Trait
 *
 * Adds filtering capabilities to Datatable.
 *
 * @package Tresorkasenda\Tables\Concerns
 */
trait HasFilters
{
    /**
     * Registered filters for the datatable.
     *
     * @var array<Filter>
     */
    protected array $filters = [];

    /**
     * Current filter values (Livewire property).
     *
     * @var array
     */
    public array $filterValues = [];

    /**
     * Register filters for the datatable.
     *
     * @param array<Filter> $filters
     * @return static
     */
    public function filters(array $filters): static
    {
        $this->filters = $filters;

        // Initialize filter values with defaults
        foreach ($filters as $filter) {
            $filterName = $filter->getName();
            if (!isset($this->filterValues[$filterName])) {
                $default = $filter->getDefault();
                if ($default !== null) {
                    $this->filterValues[$filterName] = $default;
                }
            }
        }

        return $this;
    }

    /**
     * Get all registered filters.
     *
     * @return array<Filter>
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * Apply filters to the query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applyFilters($query)
    {
        foreach ($this->filters as $filter) {
            $filterName = $filter->getName();
            $value = $this->filterValues[$filterName] ?? null;

            if ($value !== null && $value !== '' && $value !== []) {
                $query = $filter->apply($query, $value);
            }
        }

        return $query;
    }

    /**
     * Reset all filters to their default values.
     *
     * @return void
     */
    public function resetFilters(): void
    {
        $this->filterValues = [];

        foreach ($this->filters as $filter) {
            $default = $filter->getDefault();
            if ($default !== null) {
                $this->filterValues[$filter->getName()] = $default;
            }
        }
    }

    /**
     * Check if any filters are active.
     *
     * @return bool
     */
    public function hasActiveFilters(): bool
    {
        foreach ($this->filterValues as $value) {
            if ($value !== null && $value !== '' && $value !== []) {
                return true;
            }
        }

        return false;
    }
}
