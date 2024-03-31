<?php

declare(strict_types=1);

namespace App\View\Composers;

use Illuminate\View\View;
use Tresorkasenda\Menus\Sidebar;

class SideBarLayout
{
    public function compose(View $view): void
    {
        $sidebar = Sidebar::make()
            ->image('')
            ->theme('dark')
            ->route('dashboard')
            ->icon('menu')
            ->items([
                // Link items
            ]);

        $view->with('sidebar', $sidebar);
    }
}
