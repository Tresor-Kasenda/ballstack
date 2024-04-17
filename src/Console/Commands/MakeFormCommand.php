<?php

declare(strict_types=1);

namespace Tresorkasenda\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Tresorkasenda\Contracts\Generators\HasContentGenerator;
use Tresorkasenda\Contracts\Stubs\CanManipulateFiles;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;


class MakeFormCommand extends Command
{
    use CanManipulateFiles;
    use HasContentGenerator;

    protected $signature = 'make:ballstack-form
                                        {name? : The name of the ballstack Class form}
                                        {model? : The name of the model}
                                        {--E|edit}
                                        {--G|generate : Generate ballstack form}
                                        {--F|force : Force the operation to run when in production}';

    protected $description = 'Create a new Livewire component form';

    public function handle(): void
    {
        $component = (string)str(text(
            label: 'What is the form name?',
            placeholder: 'Users/CreateUser',
            required: true,
        ))
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->replace('/', '\\');

        $componentClass = (string)str($component)->append('Form')->afterLast('\\');
        $componentNamespace = str($component)->contains('\\') ? (string)str($component)->beforeLast('\\') : '';

        $view = str($component)
            ->replace('\\', '/')
            ->prepend('Livewire/')
            ->explode('/')
            ->map(fn($segment) => Str::lower(Str::kebab($segment)))
            ->implode('.');

        $model = (string)str($this->argument('model') ??
            text(
                label: 'What is the model name?',
                placeholder: 'Product',
                required: $this->option('edit')
            ))->replace('/', '\\');

        $modelClass = (string)str($model)->afterLast('\\');

        if ($this->option('edit')) {
            $isEditForm = true;
        } elseif (filled($model)) {
            $isEditForm = select(
                    label: 'Which namespace would you like to create this in?',
                    options: ['Create', 'Edit']
                ) === 'Edit';
        } else {
            $isEditForm = false;
        }

        $path = (string)str($component)
            ->prepend('/')
            ->prepend(app_path('Livewire/'))
            ->replace('\\', '/')
            ->replace('//', '/')
            ->append('Form')
            ->append('.php');

        $viewPath = resource_path(
            (string)str($view)
                ->replace('.', '/')
                ->prepend('views/')
                ->append('.blade.php'),
        );

        $this->checkIfModelExist($model);

        if (!$this->option('force') && $this->checkIfComponentExists([$path, $viewPath])) {
            return;
        }

        $this->copyStub(filled($model) ? ($isEditForm ? 'EditForm' : 'CreateForm') : 'Form', $path, [
            'class' => $componentClass,
            'model' => $model,
            'modelClass' => $modelClass,
            'namespace' => 'App\\Livewire' . ($componentNamespace !== '' ? "\\{$componentNamespace}" : ''),
            'schema' => '//',
            'view' => $view,
        ]);

        $this->copyStub('FormView', $viewPath, [
            'submitAction' => filled($model) ? ($isEditForm ? 'save' : 'create') : 'submit',
        ]);

        $this->components->info("Ballstack form [{$path}] created successfully.");

        return;

    }

    protected function checkIfModelExist(string $model): void
    {
        if ($model) {
            $modelPath = app_path("Models/{$model}.php");

            if (!File::exists($modelPath)) {
                $this->components->error("Model {$model} does not exist.");
                $this->canCreateModel($model);
            }
        }
    }
}
