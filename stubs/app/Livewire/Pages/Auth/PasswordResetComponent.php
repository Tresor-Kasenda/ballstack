<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Auth;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.guest')]
#[Title('Forget Password')]
class PasswordResetComponent extends Component
{
    #[Validate('required|string|email|exists:users')]
    public string $email = '';

    public function render(): Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|View|Application
    {
        return view('livewire.pages.auth.password-reset-component');
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
