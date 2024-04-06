<?php

namespace Tresorkasenda\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class MakeFormCommand extends Command
{

    protected $signature = 'make:ballstack-form
                                        {name? : }
                                        {model? : }
                                        {--E|edit : }
                                        {--G|generate : }
                                        {--F|force : }';

    protected $description = 'Create a new Livewire component form';

    public function handle(): int
    {
        $component = (string)str($this->argument('name') ?? text(
            label: 'What is the form name?',
            placeholder: 'Products/CreateProduct',
            required: true,
        ))
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->replace('/', '\\');
        $componentClass = (string)str($component)->afterLast('\\');
        $componentNamespace = str($component)->contains('\\') ?
            (string)str($component)->beforeLast('\\') :
            '';

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
                    options: [
                        'Create',
                        'Edit',
                    ]
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

        return static::SUCCESS;
    }

}
