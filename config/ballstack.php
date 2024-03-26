<?php

declare(strict_types=1);

use App\View\Composers\LayoutComposer;
use App\View\Composers\SideBarLayout;

return [
    /**
     *
     */
    'prefix' => '',

    /**
     *
     */
    'layout' => [
        'sidebar' => SideBarLayout::class,
        'header' => LayoutComposer::class
    ],

    'facebook' => [
        'client_id' => env('BALLSTACK_FACEBOOK_CLIENT_ID'),
        'client_secret' => env('BALLSTACK_FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('BALLSTACK_FACEBOOK_CLIENT_CALLBACK', 'http://example.com/callback-url'),
    ],
    'google' => [
        'client_id' => env('BALLSTACK_GOOGLE_CLIENT_ID'),
        'client_secret' => env('BALLSTACK_GOOGLE_CLIENT_SECRET'),
        'redirect' => env('BALLSTACK_GOOGLE_CLIENT_CALLBACK', 'http://example.com/callback-url'),
    ],
    'github' => [
        'client_id' => env('BALLSTACK_GITHUB_CLIENT_ID'),
        'client_secret' => env('BALLSTACK_GITHUB_CLIENT_SECRET'),
        'redirect' => env('BALLSTACK_GITHUB_CLIENT_CALLBACK', 'http://example.com/callback-url')
    ]
];
