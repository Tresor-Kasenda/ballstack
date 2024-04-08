<?php

declare(strict_types=1);

namespace Tresorkasenda\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Tresorkasenda\Ballstack\Ballstack;
use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class MakeUserCommand extends Command
{
    protected $signature = 'ballstack:create-admin
                            {--name= : The name of the user}
                            {--email= : A valid and unique email address}
                            {--password= : The password for the user (min. 8 characters)}';

    protected $description = 'Create a new admin user for the BallStack application';

    protected array $options = [];

    public function handle(): int
    {
        $this->options = $this->options();

        if (!Ballstack::getPanel()) {
            $this->components->error('Ballstack has not been installed yet: php artisan ballstack:install');

            return static::INVALID;
        }

        $user = $this->createUser();
        $this->sendSuccessMessage($user);

        return static::SUCCESS;
    }

    private function createUser(): User
    {
        $user = $this->getUserData();

        return User::query()->create($user);
    }

    protected function getUserData(): array
    {
        return [
            'name' => $this->options['name'] ?? text(
                    label: 'Name',
                    required: true,
                ),
            'email' => $this->options['email'] ?? text(
                    label: 'Email address',
                    required: true,
                    validate: fn(string $email): ?string => match (true) {
                        !filter_var($email, FILTER_VALIDATE_EMAIL) => 'The email address must be valid.',
                        User::query()->where('email', $email)->exists() => 'A user with this email address already exists',
                        default => null,
                    },
                ),

            'password' => Hash::make($this->options['password'] ?? password(
                label: 'Password',
                required: true,
            )),
        ];
    }

    protected function sendSuccessMessage(User $user): void
    {
        $this->components->info('Success! Your account has been created ' . $user?->email . ' with successfully');
    }
}
