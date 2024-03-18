<?php

declare(strict_types=1);

namespace Tresorkasenda\BallStack\View\Composers;

use App\View\TallFlex\Menus\Links\LinkItems;
use App\View\TallFlex\Menus\Sidebar;
use Illuminate\View\View;

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
                LinkItems::make('Home Page')
                    ->route('home')
                    ->icon('home'),
            ]);

        $view->with('sidebar', $sidebar);
    }
}
