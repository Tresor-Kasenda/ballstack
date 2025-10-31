<?php

declare(strict_types=1);

use Tresorkasenda\Forms\Forms;

test('form can be created with make method', function (): void {
    $form = Forms::make('user-form');

    expect($form)->toBeInstanceOf(Forms::class);
});

test('form can be created without name', function (): void {
    $form = Forms::make();

    expect($form)->toBeInstanceOf(Forms::class);
});

test('form can have action set', function (): void {
    $form = Forms::make('login-form')->action('/login');

    expect($form->getAction())->toBe('/login');
});

test('form action can be null', function (): void {
    $form = Forms::make('search-form');

    expect($form->getAction())->toBeNull();
});

test('form action accepts closure', function (): void {
    $form = Forms::make('dynamic-form')->action(fn() => '/dynamic/route');

    expect($form->getAction())->toBe('/dynamic/route');
});

test('form can chain multiple configurations', function (): void {
    $form = Forms::make('registration-form')
        ->action('/register');

    expect($form)->toBeInstanceOf(Forms::class)
        ->and($form->getAction())->toBe('/register');
});
