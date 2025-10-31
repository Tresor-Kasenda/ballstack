<?php

declare(strict_types=1);

namespace Tresorkasenda\Tables\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

/**
 * Base Filter Class
 *
 * Abstract base class for all datatable filters.
 *
 * @package Tresorkasenda\Tables\Filters
 */
abstract class Filter
{
    /**
     * The name/key of the filter.
     *
     * @var string
     */
    protected string $name;

    /**
     * The label to display for the filter.
     *
     * @var string|null
     */
    protected ?string $label = null;

    /**
     * The column to filter on.
     *
     * @var string|null
     */
    protected ?string $column = null;

    /**
     * Custom query callback.
     *
     * @var Closure|null
     */
    protected ?Closure $query = null;

    /**
     * Default value for the filter.
     *
     * @var mixed
     */
    protected mixed $default = null;

    /**
     * Create a new filter instance.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->column = $name;
    }

    /**
     * Create a new filter instance.
     *
     * @param string $name
     * @return static
     */
    public static function make(string $name): static
    {
        return new static($name);
    }

    /**
     * Set the label for the filter.
     *
     * @param string $label
     * @return static
     */
    public function label(string $label): static
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Get the label.
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label ?? ucfirst(str_replace('_', ' ', $this->name));
    }

    /**
     * Set the column to filter on.
     *
     * @param string $column
     * @return static
     */
    public function column(string $column): static
    {
        $this->column = $column;
        return $this;
    }

    /**
     * Get the column.
     *
     * @return string
     */
    public function getColumn(): string
    {
        return $this->column ?? $this->name;
    }

    /**
     * Set a custom query callback.
     *
     * @param Closure $callback
     * @return static
     */
    public function query(Closure $callback): static
    {
        $this->query = $callback;
        return $this;
    }

    /**
     * Set the default value.
     *
     * @param mixed $value
     * @return static
     */
    public function default(mixed $value): static
    {
        $this->default = $value;
        return $this;
    }

    /**
     * Get the default value.
     *
     * @return mixed
     */
    public function getDefault(): mixed
    {
        return $this->default;
    }

    /**
     * Get the filter name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Apply the filter to the query.
     *
     * @param Builder $query
     * @param mixed $value
     * @return Builder
     */
    public function apply(Builder $query, mixed $value): Builder
    {
        if ($this->query) {
            return ($this->query)($query, $value);
        }

        return $this->applyFilter($query, $value);
    }

    /**
     * Apply the filter logic to the query.
     * Must be implemented by child classes.
     *
     * @param Builder $query
     * @param mixed $value
     * @return Builder
     */
    abstract protected function applyFilter(Builder $query, mixed $value): Builder;

    /**
     * Get the view for rendering the filter.
     *
     * @return string
     */
    abstract public function getView(): string;

    /**
     * Get any additional data needed for the view.
     *
     * @return array
     */
    public function getViewData(): array
    {
        return [];
    }
}
