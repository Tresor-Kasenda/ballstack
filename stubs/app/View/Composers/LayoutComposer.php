<?php

declare(strict_types=1);

namespace App\View\Composers;

use Illuminate\View\View;
use Tresorkasenda\Menus\Header;

class LayoutComposer
{
    public function compose(View $view): void
    {
        $header = Header::make()
            ->logo('images/profile.jpg')
            ->theme('light')
            ->route('home')
            ->icon('menu')
            ->items([
                // your LinkLayout
            ]);

        $view->with('header', $header);
    }
}
