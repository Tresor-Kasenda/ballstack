<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.guest')]
#[Title('Forget Password')]
class PasswordReset extends Component
{
    #[Validate('required|string|email|exists:users')]
    public string $email = '';

    public function render(): View
    {
        return view('livewire.pages.auth.password-reset');
    }

    public function sendPasswordReset(): void
    {
        $this->validate();

        $status = Password::sendResetLink(
            $this->only('email')
        );

        if (Password::RESET_LINK_SENT !== $status) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}
