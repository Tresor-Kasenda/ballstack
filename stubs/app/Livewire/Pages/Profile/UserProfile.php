<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Profile;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('User Profile')]
class UserProfile extends Component
{
    public function render(): View
    {
        return view('livewire.pages.profile.user-profile');
    }
}
