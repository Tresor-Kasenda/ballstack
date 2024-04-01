<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.guest')]
#[Title('Reset Password')]
class ResetPassword extends Component
{
    #[Locked]
    #[Validate(['required'])]
    public string $token = '';

    #[Validate(['required', 'string', 'email', 'exists:users'])]
    public string $email = '';

    #[Validate(['required', 'string', 'confirmed',])]
    public string $password = '';

    #[Validate(['required', 'string'])]
    public string $password_confirmation = '';

    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->input('email');
    }

    public function render(): View
    {
        return view('livewire.pages.auth.reset-password');
    }

    public function passwordReset(): void
    {
        $this->validate();

        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user): void {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if (Password::PASSWORD_RESET !== $status) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
    }
}
