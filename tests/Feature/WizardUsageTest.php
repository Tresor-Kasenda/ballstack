<?php

declare(strict_types=1);

use Tresorkasenda\Wizard\Wizard;
use Tresorkasenda\Forms\Components\TextInput;
use Tresorkasenda\Forms\Components\SelectInput;
use Tresorkasenda\Forms\Components\DatePicker;

/**
 * Feature tests demonstrating Wizard (multi-step form) usage examples.
 */

test('can create a multi-step registration wizard', function (): void {
    $wizard = Wizard::make('registration-wizard')
        ->steps([
            [
                'title' => 'Personal Information',
                'description' => 'Enter your basic details',
                'fields' => [
                    TextInput::make('first_name')->required(),
                    TextInput::make('last_name')->required(),
                    DatePicker::make('birth_date')->required(),
                ]
            ],
            [
                'title' => 'Account Details',
                'description' => 'Create your account credentials',
                'fields' => [
                    TextInput::make('email')->email()->required(),
                    TextInput::make('password')->password()->required(),
                    TextInput::make('password_confirmation')->password()->required(),
                ]
            ],
            [
                'title' => 'Preferences',
                'description' => 'Customize your experience',
                'fields' => [
                    SelectInput::make('language')->options([
                        'en' => 'English',
                        'fr' => 'French',
                        'es' => 'Spanish',
                    ]),
                    SelectInput::make('timezone')->required(),
                ]
            ],
        ])
        ->submit(fn() => '/register');

    expect($wizard)->toBeInstanceOf(Wizard::class)
        ->and($wizard->getSteps())->toBeArray()
        ->and($wizard->getSteps())->toHaveCount(3);
});

test('can create a checkout wizard', function (): void {
    $wizard = Wizard::make('checkout-wizard')
        ->steps([
            [
                'title' => 'Shipping Information',
                'fields' => [
                    TextInput::make('address')->required(),
                    TextInput::make('city')->required(),
                    TextInput::make('postal_code')->required(),
                ]
            ],
            [
                'title' => 'Payment Method',
                'fields' => [
                    SelectInput::make('payment_method')->options([
                        'credit_card' => 'Credit Card',
                        'paypal' => 'PayPal',
                        'bank_transfer' => 'Bank Transfer',
                    ])->required(),
                ]
            ],
            [
                'title' => 'Review & Confirm',
                'fields' => []
            ],
        ])
        ->submit(fn() => '/checkout/complete');

    expect($wizard)->toBeInstanceOf(Wizard::class)
        ->and($wizard->getSteps())->toHaveCount(3)
        ->and($wizard->getSubmit())->toBe('/checkout/complete');
});

test('can create an onboarding wizard', function (): void {
    $wizard = Wizard::make('onboarding-wizard')
        ->steps([
            [
                'title' => 'Welcome',
                'description' => 'Welcome to our platform!',
                'fields' => []
            ],
            [
                'title' => 'Company Information',
                'fields' => [
                    TextInput::make('company_name')->required(),
                    TextInput::make('company_website')->url(),
                ]
            ],
            [
                'title' => 'Team Setup',
                'fields' => [
                    TextInput::make('team_size')->numeric(),
                    SelectInput::make('industry'),
                ]
            ],
        ]);

    expect($wizard)->toBeInstanceOf(Wizard::class)
        ->and($wizard->getSteps())->toHaveCount(3);
});

test('wizard steps can be accessed and validated', function (): void {
    $wizard = Wizard::make('simple-wizard')
        ->steps([
            ['title' => 'Step 1', 'fields' => []],
            ['title' => 'Step 2', 'fields' => []],
        ]);

    $steps = $wizard->getSteps();

    expect($steps)->toBeArray()
        ->and($steps[0])->toHaveKey('title')
        ->and($steps[0]['title'])->toBe('Step 1')
        ->and($steps[1]['title'])->toBe('Step 2');
});
