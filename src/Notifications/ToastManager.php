<?php

declare(strict_types=1);

namespace Tresorkasenda\Notifications;

use Livewire\Component;

/**
 * Toast Manager Component
 *
 * Livewire component for managing and displaying toast notifications.
 *
 * @package Tresorkasenda\Notifications
 */
class ToastManager extends Component
{
    /**
     * Render the toast manager component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('ballstack::notifications.toast-manager');
    }
}
