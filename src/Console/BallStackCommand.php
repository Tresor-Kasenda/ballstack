<?php

namespace Tresorkasenda\BallStack\Console;

use Illuminate\Console\Command;

class BallStackCommand extends Command
{
    protected $signature = 'ballstack:install';

    protected $description = 'This is a command for the BallStack package';

    public function handle(): void
    {
        $this->info('This is a command for the BallStack package');

    }
}
