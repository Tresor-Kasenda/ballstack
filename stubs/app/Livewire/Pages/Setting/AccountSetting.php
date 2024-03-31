<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Setting;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('User Profile')]
class AccountSetting extends Component
{
    public function render(): View
    {
        return view('livewire.pages.setting.account-setting');
    }
}
