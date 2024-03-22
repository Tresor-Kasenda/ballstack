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
            ->logo('images/profile.jpg')
            ->theme('dark')
            ->route('home')
            ->icon('menu')
            ->items([
                // Link items
            ]);

        $view->with('sidebar', $sidebar);
    }
}
