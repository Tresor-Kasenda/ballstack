<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ConfirmPassword extends Component
{
    #[Validate(['required', 'string'])]
    public string $password = '';

    public function render(): View
    {
        return view('livewire.pages.auth.confirm-password');
    }

    public function confirmPassword(): void
    {
        $this->validate();

        if ( ! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}
