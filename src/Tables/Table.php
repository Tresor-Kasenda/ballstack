<?php

declare(strict_types=1);

namespace App\View\TallFlex\Tables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination;

    abstract public function columns(array $columns): array;

    public function data(): Collection|array
    {
        return $this
            ->query()
            ->get();
    }

    abstract public function query(): Builder;
}
