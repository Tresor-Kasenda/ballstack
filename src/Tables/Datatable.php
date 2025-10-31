<?php

declare(strict_types=1);

namespace Tresorkasenda\Tables;

use Tresorkasenda\Exceptions\ModelDoesntExist;
use Exception;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Schema;
use Throwable;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasExtractPublicMethods;

/**
 * Datatable component for displaying and managing tabular data.
 *
 * This Livewire component provides pagination, sorting, searching, and actions
 * for Eloquent models. It automatically detects model columns and provides
 * a fluent interface for configuring the table display.
 *
 * @example
 * ```php
 * Datatable::make('users-table')
 *     ->model(User::class, perPage: 15)
 *     ->fields(['name', 'email', 'created_at'])
 *     ->actions([
 *         'edit' => 'Edit User',
 *         'delete' => 'Delete User',
 *     ]);
 * ```
 */
class Datatable extends Component implements Htmlable
{
    use HasEvaluated;
    use HasExtractPublicMethods;
    use WithPagination;

    protected array $model = [];

    protected array $fields = [];

    protected string $sortColumn = 'id';

    protected string $sortDirection = 'asc';

    protected array|null $actions = [];

    public function __construct(
        public ?string $name = null
    ) {
    }

    public static function make(string $name): static
    {
        return new static($name);
    }

    /**
     * @throws Throwable
     */
    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function render(): View
    {
        return view('ballstack::datatable.table', $this->extractPublicMethods());
    }

    /**
     * Set the Eloquent model for the datatable.
     *
     * @param string $modelClass Fully qualified model class name
     * @param int $perPage Number of records per page (default: 10)
     * @return static
     * @throws ModelDoesntExist When the provided class is not a valid Eloquent model
     */
    public function model(string $modelClass, int $perPage = 10): static
    {
        if ( ! is_subclass_of($modelClass, Model::class)) {
            throw new ModelDoesntExist("The class {$modelClass} is not a valid Eloquent model.");
        }

        $modelInstance = new $modelClass();
        $this->model = [
            'columns' => Schema::getColumnListing($modelInstance->getTable()),
            'data' => $modelClass::query()
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->paginate($perPage)
        ];

        return $this;
    }

    public function getModels(): array
    {
        return $this->model;
    }

    /**
     * Set the fields (columns) to display in the datatable.
     *
     * An 'actions' column is automatically added to the end of the field list.
     *
     * @param array $fields Array of field names to display
     * @return static
     * @throws Exception When a field doesn't exist in the model
     */
    public function fields(array $fields): static
    {
        if ([] !== $this->model) {
            foreach ($fields as $field) {
                if ( ! in_array($field, $this->model['columns'])) {
                    throw new Exception("The field {$field} does not exist in the model.");
                }
            }
        }

        $this->fields = array_merge($fields, ['actions' => 'Actions']);

        return $this;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Sort the datatable by a column.
     *
     * If the column is already sorted, it toggles between ascending and descending.
     * Otherwise, it sets the column as the sort column with ascending direction.
     *
     * @param string $name Column name to sort by
     * @return static
     */
    public function sort(string $name): static
    {
        if ($this->sortColumn === $name) {
            $this->sortDirection = 'asc' === $this->sortDirection ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $name;
            $this->sortDirection = 'asc';
        }

        return $this;
    }

    /**
     * Set the actions available for each row in the datatable.
     *
     * @param array $actions Associative array of action key => action label
     * @return static
     */
    public function actions(array $actions): static
    {
        $this->actions = $actions;

        return $this;
    }

    public function getActions(): array
    {
        return $this->actions;
    }

    public function search(string $search): static
    {
        if ([] !== $this->model) {
            $this->model['data'] = $this->model['data']->filter(fn ($item) => Str::contains($item, $search));
        }

        return $this;
    }
}
