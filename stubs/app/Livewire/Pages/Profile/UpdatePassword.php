<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Profile;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Tresorkasenda\Forms\Components\TextInput;
use Tresorkasenda\Forms\Forms;

#[Layout('layouts.app')]
#[Title('Update Password')]
class UpdatePassword extends Component
{
    #[Validate(['required', 'string', 'email', 'exists:users'])]
    public string $email = '';

    #[Validate(['required', 'string', 'confirmed'])]
    public string $password = '';

    #[Validate(['required', 'string'])]
    public string $password_confirmation = '';

    public function render(): View
    {
        return view('livewire.pages.profile.update-password');
    }

    public function submit(): void
    {
        $this->validate();

        $user = User::query()->where('email', $this->email)->firstOrFail();

        if ($user) {
            tap($user)->update([
                'password' => Hash::make($this->password),
            ]);
            event(new PasswordReset($user));
        }

        session()->flash('status', 'Password updated successfully!');

        $this->redirectRoute('profile', true);
    }

    public function form()
    {
        return Forms::make()
            ->hasCard()
            ->schema([
                TextInput::make('email')
                    ->label(__('Adresse Email'))
                    ->email()
                    ->required()
                    ->autocomplete(),
                TextInput::make('password')
                    ->label(__('Mot de passe'))
                    ->password()
                    ->required()
                    ->minLength(6),
                TextInput::make('password_confirmation')
                    ->label(__('Mot de passe (confirmation)'))
                    ->password()
                    ->required()
                    ->minLength(6)
            ])
            ->action(__('Reset Password'));
    }
}
