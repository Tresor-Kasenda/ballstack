# 💻 Exemples d'Implémentation des Features Prioritaires

Ce document fournit des exemples concrets d'implémentation pour les features les plus importantes et demandées.

---

## 🎯 Feature 1: MultiSelect Component

### Structure de Fichiers
```
src/Forms/Components/MultiSelect.php
resources/views/forms/components/multi-select.blade.php
```

### Code PHP (src/Forms/Components/MultiSelect.php)

```php
<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Closure;
use Tresorkasenda\Contracts\HasOptions;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Contracts\HasSearchable;
use Tresorkasenda\Forms\Field;

/**
 * MultiSelect component for multiple selection with tags.
 *
 * @example
 * ```php
 * MultiSelect::make('skills')
 *     ->options(['php' => 'PHP', 'js' => 'JavaScript'])
 *     ->searchable()
 *     ->maxItems(5)
 *     ->taggable();
 * ```
 */
class MultiSelect extends Field
{
    use HasOptions;
    use HasPlaceholder;
    use HasRequired;
    use HasSearchable;

    protected array|Closure $selected = [];
    protected int|null $maxItems = null;
    protected bool $taggable = false;
    protected string $view = "ballstack::forms.components.multi-select";

    /**
     * Set maximum number of selectable items.
     */
    public function maxItems(int $max): static
    {
        $this->maxItems = $max;
        return $this;
    }

    /**
     * Get maximum items allowed.
     */
    public function getMaxItems(): ?int
    {
        return $this->maxItems;
    }

    /**
     * Enable custom tag creation.
     */
    public function taggable(bool $taggable = true): static
    {
        $this->taggable = $taggable;
        return $this;
    }

    /**
     * Check if tagging is enabled.
     */
    public function isTaggable(): bool
    {
        return $this->taggable;
    }

    /**
     * Set initially selected values.
     */
    public function default(array $values): static
    {
        $this->selected = $values;
        return $this;
    }

    /**
     * Get selected values.
     */
    public function getSelected(): array
    {
        return $this->evaluate($this->selected);
    }
}
```

### Blade Template (resources/views/forms/components/multi-select.blade.php)

```blade
<div x-data="{
    selected: @entangle($attributes->wire('model')),
    search: '',
    open: false,
    maxItems: {{ $getMaxItems() ?? 'null' }},

    toggle() {
        this.open = !this.open;
    },

    select(value) {
        if (!this.selected.includes(value)) {
            if (this.maxItems === null || this.selected.length < this.maxItems) {
                this.selected.push(value);
            }
        }
        this.search = '';
    },

    remove(value) {
        this.selected = this.selected.filter(item => item !== value);
    },

    get filteredOptions() {
        const options = @json($getOptions());
        return Object.entries(options).filter(([key, label]) => {
            return label.toLowerCase().includes(this.search.toLowerCase()) &&
                   !this.selected.includes(key);
        });
    }
}" class="relative">

    <label class="form-label">{{ $getLabel() }}</label>

    <!-- Selected Tags -->
    <div class="flex flex-wrap gap-2 mb-2">
        <template x-for="item in selected" :key="item">
            <span class="badge badge-primary">
                <span x-text="item"></span>
                <button type="button" @click="remove(item)" class="ml-1">×</button>
            </span>
        </template>
    </div>

    <!-- Search Input -->
    <div class="position-relative">
        <input
            type="text"
            x-model="search"
            @focus="open = true"
            @click.away="open = false"
            placeholder="{{ $getPlaceholder() ?? 'Search or select...' }}"
            class="form-control"
            {{ $isRequired() ? 'required' : '' }}
        />
    </div>

    <!-- Options Dropdown -->
    <div x-show="open"
         x-transition
         class="dropdown-menu show"
         style="max-height: 200px; overflow-y: auto;">
        <template x-for="[key, label] in filteredOptions" :key="key">
            <button
                type="button"
                @click="select(key); toggle();"
                class="dropdown-item"
                x-text="label">
            </button>
        </template>

        <div x-show="filteredOptions.length === 0" class="dropdown-item disabled">
            No options found
        </div>
    </div>

    @if($getHelpText())
        <small class="form-text text-muted">{{ $getHelpText() }}</small>
    @endif
</div>
```

---

## 🎯 Feature 2: Bulk Actions pour Datatable

### Structure
```
src/Tables/Concerns/HasBulkActions.php
src/Tables/BulkAction.php
```

### Trait HasBulkActions

```php
<?php

declare(strict_types=1);

namespace Tresorkasenda\Tables\Concerns;

use Closure;

trait HasBulkActions
{
    protected array $bulkActions = [];
    protected array $selectedRows = [];
    protected array $confirmableActions = [];

    /**
     * Set bulk actions.
     */
    public function bulkActions(array $actions): static
    {
        $this->bulkActions = $actions;
        return $this;
    }

    /**
     * Get bulk actions.
     */
    public function getBulkActions(): array
    {
        return $this->bulkActions;
    }

    /**
     * Set actions that require confirmation.
     */
    public function confirmBulkAction(string|array $actions): static
    {
        $this->confirmableActions = is_array($actions) ? $actions : [$actions];
        return $this;
    }

    /**
     * Execute bulk action.
     */
    public function executeBulkAction(string $action): void
    {
        if (method_exists($this, 'bulk' . ucfirst($action))) {
            $this->{'bulk' . ucfirst($action)}($this->selectedRows);
        }

        $this->selectedRows = [];
    }

    /**
     * Select all rows.
     */
    public function selectAll(): void
    {
        $this->selectedRows = $this->getModels()['data']->pluck('id')->toArray();
    }

    /**
     * Deselect all rows.
     */
    public function deselectAll(): void
    {
        $this->selectedRows = [];
    }

    /**
     * Toggle row selection.
     */
    public function toggleRow(int $id): void
    {
        if (in_array($id, $this->selectedRows)) {
            $this->selectedRows = array_diff($this->selectedRows, [$id]);
        } else {
            $this->selectedRows[] = $id;
        }
    }
}
```

### Exemple d'Utilisation

```php
<?php

namespace App\Livewire;

use App\Models\User;
use Tresorkasenda\Tables\Datatable;

class UsersTable extends Datatable
{
    public function model(string $modelClass, int $perPage = 10): static
    {
        return parent::model(User::class, 15)
            ->fields(['name', 'email', 'created_at'])
            ->bulkActions([
                'delete' => 'Delete Selected',
                'archive' => 'Archive Selected',
                'export' => 'Export to CSV',
            ])
            ->confirmBulkAction(['delete', 'archive']);
    }

    /**
     * Bulk delete action.
     */
    protected function bulkDelete(array $ids): void
    {
        User::whereIn('id', $ids)->delete();

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => count($ids) . ' users deleted successfully'
        ]);
    }

    /**
     * Bulk archive action.
     */
    protected function bulkArchive(array $ids): void
    {
        User::whereIn('id', $ids)->update(['archived' => true]);

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => count($ids) . ' users archived'
        ]);
    }

    /**
     * Bulk export action.
     */
    protected function bulkExport(array $ids): void
    {
        $users = User::whereIn('id', $ids)->get();

        // Logic to export to CSV
        // ...

        return response()->download($filePath);
    }
}
```

---

## 🎯 Feature 3: Export Excel/CSV

### Structure
```
src/Tables/Concerns/HasExport.php
src/Tables/Exports/DatatableExport.php
```

### Trait HasExport

```php
<?php

declare(strict_types=1);

namespace Tresorkasenda\Tables\Concerns;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Tresorkasenda\Tables\Exports\DatatableExport;

trait HasExport
{
    protected array $exportFormats = [];
    protected array $exportColumns = [];
    protected bool $exportable = false;

    /**
     * Enable export functionality.
     */
    public function exportable(array $formats = ['excel', 'csv']): static
    {
        $this->exportable = true;
        $this->exportFormats = $formats;
        return $this;
    }

    /**
     * Set columns to export.
     */
    public function exportColumns(array $columns): static
    {
        $this->exportColumns = $columns;
        return $this;
    }

    /**
     * Get export columns.
     */
    public function getExportColumns(): array
    {
        return $this->exportColumns ?: $this->getFields();
    }

    /**
     * Check if export is enabled.
     */
    public function isExportable(): bool
    {
        return $this->exportable;
    }

    /**
     * Get available export formats.
     */
    public function getExportFormats(): array
    {
        return $this->exportFormats;
    }

    /**
     * Export to Excel.
     */
    public function exportToExcel(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $data = $this->getExportData();
        $filename = $this->name . '_' . now()->format('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(
            new DatatableExport($data, $this->getExportColumns()),
            $filename
        );
    }

    /**
     * Export to CSV.
     */
    public function exportToCsv(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $data = $this->getExportData();
        $filename = $this->name . '_' . now()->format('Y-m-d_H-i-s') . '.csv';

        return Excel::download(
            new DatatableExport($data, $this->getExportColumns()),
            $filename,
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    /**
     * Get data for export.
     */
    protected function getExportData(): \Illuminate\Support\Collection
    {
        // Get all data without pagination
        return $this->query()->get();
    }
}
```

### Export Class

```php
<?php

declare(strict_types=1);

namespace Tresorkasenda\Tables\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DatatableExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(
        protected Collection $data,
        protected array $columns
    ) {}

    /**
     * Get the collection to export.
     */
    public function collection(): Collection
    {
        return $this->data;
    }

    /**
     * Get column headings.
     */
    public function headings(): array
    {
        return array_map(
            fn($column) => ucfirst(str_replace('_', ' ', $column)),
            $this->columns
        );
    }

    /**
     * Map data for each row.
     */
    public function map($row): array
    {
        return collect($this->columns)
            ->map(fn($column) => data_get($row, $column))
            ->toArray();
    }
}
```

---

## 🎯 Feature 4: Toast Notifications

### Structure
```
src/Notifications/Toast.php
resources/views/components/toast.blade.php
```

### Toast Class

```php
<?php

declare(strict_types=1);

namespace Tresorkasenda\Notifications;

use Livewire\Component;

class Toast extends Component
{
    public string $type = 'info';
    public string $message = '';
    public string $title = '';
    public int $duration = 3000;
    public string $position = 'top-right';
    public bool $closable = true;
    public bool $show = false;

    protected $listeners = ['toast' => 'showToast'];

    /**
     * Show toast notification.
     */
    public function showToast(array $data): void
    {
        $this->type = $data['type'] ?? 'info';
        $this->message = $data['message'] ?? '';
        $this->title = $data['title'] ?? '';
        $this->duration = $data['duration'] ?? 3000;
        $this->position = $data['position'] ?? 'top-right';
        $this->closable = $data['closable'] ?? true;

        $this->show = true;

        if ($this->duration > 0) {
            $this->dispatch('auto-close', delay: $this->duration);
        }
    }

    /**
     * Close toast.
     */
    public function close(): void
    {
        $this->show = false;
    }

    /**
     * Static helper methods.
     */
    public static function success(string $message, ?string $title = null): array
    {
        return [
            'type' => 'success',
            'message' => $message,
            'title' => $title ?? 'Success',
        ];
    }

    public static function error(string $message, ?string $title = null): array
    {
        return [
            'type' => 'error',
            'message' => $message,
            'title' => $title ?? 'Error',
        ];
    }

    public static function warning(string $message, ?string $title = null): array
    {
        return [
            'type' => 'warning',
            'message' => $message,
            'title' => $title ?? 'Warning',
        ];
    }

    public static function info(string $message, ?string $title = null): array
    {
        return [
            'type' => 'info',
            'message' => $message,
            'title' => $title ?? 'Info',
        ];
    }

    public function render()
    {
        return view('ballstack::components.toast');
    }
}
```

### Blade Component

```blade
<div x-data="{
    show: @entangle('show'),
    type: @entangle('type'),
    position: '{{ $position }}'
}"
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform translate-y-2"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-2"
     @auto-close.window="setTimeout(() => show = false, $event.detail.delay)"
     class="toast-container position-fixed"
     :class="{
         'top-0 end-0 m-3': position === 'top-right',
         'top-0 start-0 m-3': position === 'top-left',
         'bottom-0 end-0 m-3': position === 'bottom-right',
         'bottom-0 start-0 m-3': position === 'bottom-left',
     }"
     style="z-index: 9999;">

    <div class="toast show"
         role="alert"
         :class="{
             'bg-success': type === 'success',
             'bg-danger': type === 'error',
             'bg-warning': type === 'warning',
             'bg-info': type === 'info',
         }">
        <div class="toast-header">
            <strong class="me-auto">{{ $title }}</strong>
            @if($closable)
                <button type="button"
                        class="btn-close"
                        @click="show = false"
                        aria-label="Close"></button>
            @endif
        </div>
        <div class="toast-body text-white">
            {{ $message }}
        </div>
    </div>
</div>
```

### Usage dans Livewire

```php
// Dans un composant Livewire
public function save()
{
    // Logic...

    $this->dispatch('toast', Toast::success('User saved successfully'));
}

public function delete()
{
    // Logic...

    $this->dispatch('toast', [
        'type' => 'error',
        'message' => 'Failed to delete user',
        'duration' => 5000,
        'position' => 'top-center'
    ]);
}
```

---

## 🎯 Feature 5: Conditional Fields

### Dans FormComponent

```php
<?php

namespace Tresorkasenda\Forms\Concerns;

use Closure;

trait HasConditionalVisibility
{
    protected Closure|bool|null $visible = null;
    protected Closure|bool|null $hidden = null;

    /**
     * Set field visibility condition.
     */
    public function visible(Closure|bool $condition): static
    {
        $this->visible = $condition;
        return $this;
    }

    /**
     * Set field hidden condition.
     */
    public function hidden(Closure|bool $condition): static
    {
        $this->hidden = $condition;
        return $this;
    }

    /**
     * Check if field is visible.
     */
    public function isVisible(Closure $get): bool
    {
        if ($this->visible !== null) {
            return $this->visible instanceof Closure
                ? ($this->visible)($get)
                : $this->visible;
        }

        if ($this->hidden !== null) {
            $hidden = $this->hidden instanceof Closure
                ? ($this->hidden)($get)
                : $this->hidden;
            return !$hidden;
        }

        return true;
    }
}
```

### Usage

```php
Forms::make('user-form')
    ->schema([
        Select::make('account_type')
            ->options([
                'personal' => 'Personal',
                'business' => 'Business',
            ])
            ->required(),

        TextInput::make('company_name')
            ->visible(fn($get) => $get('account_type') === 'business')
            ->required(),

        TextInput::make('tax_id')
            ->visible(fn($get) => $get('account_type') === 'business'),

        TextInput::make('nickname')
            ->hidden(fn($get) => $get('account_type') === 'business'),
    ]);
```

---

## 🎯 Feature 6: Stats Card Widget

### Structure
```
src/Widgets/StatsCard.php
resources/views/widgets/stats-card.blade.php
```

### StatsCard Class

```php
<?php

declare(strict_types=1);

namespace Tresorkasenda\Widgets;

use Closure;
use Livewire\Component;

/**
 * Stats Card Widget for displaying key metrics.
 *
 * @example
 * ```php
 * StatsCard::make('Total Users')
 *     ->value(1250)
 *     ->increase(12.5)
 *     ->icon('users')
 *     ->color('primary');
 * ```
 */
class StatsCard extends Component
{
    public string $title;
    public int|float|string|Closure $value;
    public ?float $increase = null;
    public ?string $icon = null;
    public string $color = 'primary';
    public ?array $chart = null;
    public ?string $description = null;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public static function make(string $title): static
    {
        return new static($title);
    }

    public function value(int|float|string|Closure $value): static
    {
        $this->value = $value;
        return $this;
    }

    public function increase(?float $percentage): static
    {
        $this->increase = $percentage;
        return $this;
    }

    public function icon(?string $icon): static
    {
        $this->icon = $icon;
        return $this;
    }

    public function color(string $color): static
    {
        $this->color = $color;
        return $this;
    }

    public function chart(?array $data): static
    {
        $this->chart = $data;
        return $this;
    }

    public function description(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getValue(): int|float|string
    {
        return $this->value instanceof Closure
            ? ($this->value)()
            : $this->value;
    }

    public function render()
    {
        return view('ballstack::widgets.stats-card');
    }
}
```

### Blade View

```blade
<div class="card border-{{ $color }}">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h6 class="text-muted mb-2">{{ $title }}</h6>
                <h2 class="mb-0">{{ $getValue() }}</h2>

                @if($increase !== null)
                    <p class="mb-0 mt-2">
                        <span class="badge {{ $increase >= 0 ? 'bg-success' : 'bg-danger' }}">
                            <i class="bi bi-arrow-{{ $increase >= 0 ? 'up' : 'down' }}"></i>
                            {{ abs($increase) }}%
                        </span>
                        <span class="text-muted ms-2">vs last period</span>
                    </p>
                @endif

                @if($description)
                    <p class="text-muted small mt-2 mb-0">{{ $description }}</p>
                @endif
            </div>

            @if($icon)
                <div class="text-{{ $color }}" style="font-size: 2rem;">
                    <i class="bi bi-{{ $icon }}"></i>
                </div>
            @endif
        </div>

        @if($chart)
            <div class="mt-3">
                <canvas id="chart-{{ Str::slug($title) }}" height="50"></canvas>
            </div>

            @push('scripts')
                <script>
                    // Simple sparkline chart
                    const ctx = document.getElementById('chart-{{ Str::slug($title) }}');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: @json(array_keys($chart)),
                            datasets: [{
                                data: @json(array_values($chart)),
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.1
                            }]
                        },
                        options: {
                            plugins: { legend: { display: false } },
                            scales: { y: { display: false }, x: { display: false } }
                        }
                    });
                </script>
            @endpush
        @endif
    </div>
</div>
```

### Usage

```php
// Dans un Dashboard
public function widgets(): array
{
    return [
        StatsCard::make('Total Users')
            ->value(User::count())
            ->increase(12.5)
            ->icon('people')
            ->color('primary')
            ->description('Active users in the system'),

        StatsCard::make('Revenue')
            ->value('$' . number_format(Order::sum('total'), 2))
            ->increase(-5.3)
            ->icon('currency-dollar')
            ->color('success')
            ->chart([
                'Jan' => 1200,
                'Feb' => 1900,
                'Mar' => 3000,
                'Apr' => 5000,
            ]),

        StatsCard::make('Orders')
            ->value(Order::whereDate('created_at', today())->count())
            ->increase(8.7)
            ->icon('cart')
            ->color('info'),
    ];
}
```

---

## 📝 Conclusion

Ces exemples fournissent une base solide pour implémenter les features les plus demandées. Chaque composant suit les patterns établis dans BallStack et peut être facilement étendu.

### Prochaines Étapes

1. Choisir les features prioritaires
2. Créer les branches feature pour chaque implémentation
3. Écrire les tests unitaires et d'intégration
4. Documenter chaque feature
5. Créer des exemples d'utilisation

