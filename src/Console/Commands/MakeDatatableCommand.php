<?php

declare(strict_types=1);

namespace Tresorkasenda\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

/**
 * Make Datatable Command
 *
 * Generate a datatable component with filters, export, and bulk actions.
 *
 * @package Tresorkasenda\Console\Commands
 */
class MakeDatatableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ballstack:datatable
                            {name : The name of the datatable}
                            {--model= : The model class}
                            {--filters : Include filters}
                            {--export : Include export functionality}
                            {--bulk : Include bulk actions}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a BallStack datatable component';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $model = $this->option('model');
        $includeFilters = $this->option('filters');
        $includeExport = $this->option('export');
        $includeBulk = $this->option('bulk');

        if (!$model) {
            $model = $this->ask('What is the model class?', 'App\\Models\\User');
        }

        $className = Str::studly($name) . 'Datatable';
        $modelShortName = class_basename($model);

        $stub = $this->getStub($includeFilters, $includeExport, $includeBulk);
        $stub = $this->replaceTokens($stub, $className, $model, $modelShortName);

        $path = app_path("Livewire/Datatables/{$className}.php");
        $directory = dirname($path);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        if (file_exists($path)) {
            $this->error("Datatable {$className} already exists!");
            return 1;
        }

        file_put_contents($path, $stub);

        $this->info("Datatable {$className} created successfully!");
        $this->info("Location: {$path}");

        return 0;
    }

    /**
     * Get the stub content.
     *
     * @param bool $filters
     * @param bool $export
     * @param bool $bulk
     * @return string
     */
    protected function getStub(bool $filters, bool $export, bool $bulk): string
    {
        $traits = [];
        $methods = [];

        if ($filters) {
            $traits[] = 'use HasFilters;';
            $methods[] = $this->getFiltersMethod();
        }

        if ($export) {
            $traits[] = 'use HasExport;';
        }

        if ($bulk) {
            $traits[] = 'use HasBulkActions;';
            $methods[] = $this->getBulkActionsMethod();
        }

        $traitsString = !empty($traits) ? "\n    " . implode("\n    ", $traits) : '';
        $methodsString = !empty($methods) ? "\n\n" . implode("\n\n", $methods) : '';

        return <<<PHP
<?php

declare(strict_types=1);

namespace App\Livewire\Datatables;

use {{modelClass}};
use Tresorkasenda\Tables\Datatable;
{{filterImports}}
{{traitImports}}

class {{className}} extends Datatable
{{{traits}}

    public function mount(): void
    {
        \$this->model({{modelShortName}}::class, perPage: 15)
            ->fields(['id', 'name', 'created_at'])
            ->actions([
                'edit' => 'Edit',
                'delete' => 'Delete',
            ]);{{configMethods}}
    }

    protected function getBaseQuery()
    {
        \$query = {{modelShortName}}::query();

        // Apply filters if trait is used
        if (method_exists(\$this, 'applyFilters')) {
            \$query = \$this->applyFilters(\$query);
        }

        return \$query
            ->orderBy(\$this->sortColumn, \$this->sortDirection);
    }{{methods}}
}
PHP;
    }

    /**
     * Get the filters method stub.
     *
     * @return string
     */
    protected function getFiltersMethod(): string
    {
        return <<<'PHP'
    /**
     * Configure filters for the datatable.
     *
     * @return void
     */
    protected function configureFilters(): void
    {
        $this->filters([
            TextFilter::make('search')
                ->label('Search')
                ->placeholder('Search by name...'),

            SelectFilter::make('status')
                ->label('Status')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ]),

            DateRangeFilter::make('created_at')
                ->label('Created Date'),
        ]);
    }
PHP;
    }

    /**
     * Get the bulk actions method stub.
     *
     * @return string
     */
    protected function getBulkActionsMethod(): string
    {
        return <<<'PHP'
    /**
     * Configure bulk actions for the datatable.
     *
     * @return void
     */
    protected function configureBulkActions(): void
    {
        $this->bulkActions([
            'delete' => function ($ids) {
                {{modelShortName}}::whereIn('id', $ids)->delete();
                return true;
            },
            'export' => function ($ids) {
                // Export selected items
                return $this->exportToCsv();
            },
        ])->confirmBulkAction('delete');
    }
PHP;
    }

    /**
     * Replace tokens in the stub.
     *
     * @param string $stub
     * @param string $className
     * @param string $modelClass
     * @param string $modelShortName
     * @return string
     */
    protected function replaceTokens(string $stub, string $className, string $modelClass, string $modelShortName): string
    {
        $filterImports = '';
        $traitImports = '';
        $configMethods = '';

        if ($this->option('filters')) {
            $filterImports .= "use Tresorkasenda\Tables\Filters\TextFilter;\n";
            $filterImports .= "use Tresorkasenda\Tables\Filters\SelectFilter;\n";
            $filterImports .= "use Tresorkasenda\Tables\Filters\DateRangeFilter;\n";
            $traitImports .= "use Tresorkasenda\Tables\Concerns\HasFilters;\n";
            $configMethods .= "\n\n        \$this->configureFilters();";
        }

        if ($this->option('export')) {
            $traitImports .= "use Tresorkasenda\Tables\Concerns\HasExport;\n";
            $configMethods .= "\n        \$this->exportable(['excel', 'csv']);";
        }

        if ($this->option('bulk')) {
            $traitImports .= "use Tresorkasenda\Tables\Concerns\HasBulkActions;\n";
            $configMethods .= "\n        \$this->configureBulkActions();";
        }

        return str_replace(
            ['{{className}}', '{{modelClass}}', '{{modelShortName}}', '{{filterImports}}', '{{traitImports}}', '{{configMethods}}'],
            [$className, $modelClass, $modelShortName, $filterImports, $traitImports, $configMethods],
            $stub
        );
    }
}
