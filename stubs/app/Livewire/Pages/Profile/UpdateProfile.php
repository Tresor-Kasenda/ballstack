<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Tresorkasenda\Forms\Components\TextInput;
use Tresorkasenda\Forms\Forms;

#[Layout('layouts.app')]
#[Title('Update Profile')]
class UpdateProfile extends Component
{
    public string|null $name = '';

    public string|null $email = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function render(): View
    {
        return view('livewire.pages.profile.update-profile');
    }

    public function submit(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name, email: $user->email);

        $this->redirectRoute(name: 'profile', navigate: true);
    }

    public function form(): Forms
    {
        return Forms::make()
            ->hasCard()
            ->column(2)
            ->schema([
                TextInput::make('name')
                    ->label('Entrez votre nom')
                    ->required()
                    ->minLength(3),
                TextInput::make('email')
                    ->label('Entrez votre email')
                    ->required()
                    ->email()
                    ->minLength(3),
            ])
            ->action(__('Mettre a jours'));
    }
}
