<?php

declare(strict_types=1);

namespace Tresorkasenda\Tables\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Date Range Filter
 *
 * Filter for date ranges with start and end dates.
 *
 * @package Tresorkasenda\Tables\Filters
 */
class DateRangeFilter extends Filter
{
    /**
     * Date format for display.
     *
     * @var string
     */
    protected string $format = 'Y-m-d';

    /**
     * Placeholder for start date.
     *
     * @var string|null
     */
    protected ?string $startPlaceholder = null;

    /**
     * Placeholder for end date.
     *
     * @var string|null
     */
    protected ?string $endPlaceholder = null;

    /**
     * Set the date format.
     *
     * @param string $format
     * @return static
     */
    public function format(string $format): static
    {
        $this->format = $format;
        return $this;
    }

    /**
     * Get the date format.
     *
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Set placeholders for start and end dates.
     *
     * @param string $start
     * @param string $end
     * @return static
     */
    public function placeholders(string $start, string $end): static
    {
        $this->startPlaceholder = $start;
        $this->endPlaceholder = $end;
        return $this;
    }

    /**
     * Get the start placeholder.
     *
     * @return string
     */
    public function getStartPlaceholder(): string
    {
        return $this->startPlaceholder ?? __('Start Date');
    }

    /**
     * Get the end placeholder.
     *
     * @return string
     */
    public function getEndPlaceholder(): string
    {
        return $this->endPlaceholder ?? __('End Date');
    }

    /**
     * {@inheritDoc}
     */
    protected function applyFilter(Builder $query, mixed $value): Builder
    {
        if (empty($value) || !is_array($value)) {
            return $query;
        }

        $column = $this->getColumn();
        $startDate = $value['start'] ?? $value[0] ?? null;
        $endDate = $value['end'] ?? $value[1] ?? null;

        if ($startDate) {
            $query->whereDate($column, '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate($column, '<=', $endDate);
        }

        return $query;
    }

    /**
     * {@inheritDoc}
     */
    public function getView(): string
    {
        return 'ballstack::datatable.filters.date-range';
    }

    /**
     * {@inheritDoc}
     */
    public function getViewData(): array
    {
        return [
            'format' => $this->getFormat(),
            'startPlaceholder' => $this->getStartPlaceholder(),
            'endPlaceholder' => $this->getEndPlaceholder(),
        ];
    }
}
