<?php

declare(strict_types=1);

use App\View\Composers\LayoutComposer;
use App\View\Composers\SideBarLayout;

return [
    'layout' => [
        'sidebar' => SideBarLayout::class,
        'header' => LayoutComposer::class
    ]
];
