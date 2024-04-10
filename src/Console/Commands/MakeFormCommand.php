<?php

declare(strict_types=1);

namespace Tresorkasenda\Console\Commands;

use Illuminate\Console\Command;

class MakeFormCommand extends Command
{
    protected $signature = 'make:ballstack-form
                                        {name? : }
                                        {model? : }
                                        {--E|edit : }
                                        {--G|generate : }
                                        {--F|force : }';

    protected $description = 'Create a new Livewire component form';

    public function handle(): void
    {

    }
}
