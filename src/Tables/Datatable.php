<?php

declare(strict_types=1);

namespace App\View\TallFlex\Tables;

use App\View\TallFlex\Contracts\HasEvaluated;
use App\View\TallFlex\Contracts\HasExtractPublicMethods;
use App\View\TallFlex\Exceptions\ModelDoesntExist;
use Exception;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Schema;
use Throwable;

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
    )
    {
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
        return view('components.datatable.table', $this->extractPublicMethods());
    }

    public function model(string $modelClass, int $perPage = 10): static
    {
        if (!is_subclass_of($modelClass, Model::class)) {
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

    public function fields(array $fields): static
    {
        if ([] !== $this->model) {
            foreach ($fields as $field) {
                if (!in_array($field, $this->model['columns'])) {
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
            $this->model['data'] = $this->model['data']->filter(fn($item) => Str::contains($item, $search));
        }

        return $this;
    }
}
