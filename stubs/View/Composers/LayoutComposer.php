<?php

declare(strict_types=1);

namespace App\View\Composers;

use App\View\TallFlex\Menus\Header;
use App\View\TallFlex\Menus\Links\DropdownList;
use Illuminate\View\View;

class LayoutComposer
{
    public function compose(View $view): void
    {
        $header = Header::make('')
            ->logo('images/profile.jpg')
            ->theme('light')
            ->route('home')
            ->icon('menu')
            ->items([
                DropdownList::make('')
            ]);

        $view->with('header', $header);
    }
}
