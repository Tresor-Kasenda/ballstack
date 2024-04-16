<?php

declare(strict_types=1);

namespace Tresorkasenda\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;


class MakeFormCommand extends Command
{
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

        $componentClass = (string)str($component)->afterLast('\\');
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
            ->append('.php');

        $viewPath = resource_path(
            (string)str($view)
                ->replace('.', '/')
                ->prepend('views/')
                ->append('.blade.php'),
        );
//        dd(
//            viewPath: $viewPath,
//            path: $path,
//            modelClass: $modelClass,
//            isEditForm: $isEditForm,
//            model: $model,
//            view: $view,
//            componentClass: $componentClass,
//            componentNamespace: $componentNamespace,
//            component: $component
//        );
        $createClassStubs = File::get(__DIR__ . '/../../../stubs/CreateForm.stub');
        $updateClassStubs = File::get(__DIR__ . '/../../../stubs/EditForm.stub');
        $formStubs = File::get(__DIR__ . '/../../../stubs/FormView.stub');

    }

    protected function verifyIfClassExist(string $string)
    {

    }
}
