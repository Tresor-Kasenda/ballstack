<?php

declare(strict_types=1);

use Tresorkasenda\Forms\Components\TextInput;
use Tresorkasenda\Forms\Components\SelectInput;
use Tresorkasenda\Forms\Components\DatePicker;
use Tresorkasenda\Forms\Components\Textarea;
use Tresorkasenda\Forms\Forms;

/**
 * Feature tests demonstrating real-world form building scenarios.
 */

test('can build a complete user registration form', function (): void {
    $form = Forms::make('user-registration')
        ->action('/register')
        ->schema([
            TextInput::make('name')
                ->required()
                ->placeholder('Enter your full name')
                ->minLength(3)
                ->maxLength(100),

            TextInput::make('email')
                ->email()
                ->required()
                ->placeholder('you@example.com')
                ->helpText('We will never share your email'),

            TextInput::make('password')
                ->password()
                ->required()
                ->minLength(8)
                ->helpText('Must be at least 8 characters'),

            TextInput::make('phone')
                ->tel()
                ->placeholder('+1 (555) 123-4567')
                ->pattern('[0-9]{3}-[0-9]{3}-[0-9]{4}'),
        ]);

    expect($form)->toBeInstanceOf(Forms::class)
        ->and($form->getAction())->toBe('/register')
        ->and($form->getSchema())->toHaveCount(4);
});

test('can build a contact form with various input types', function (): void {
    $form = Forms::make('contact-form')
        ->action('/contact')
        ->schema([
            TextInput::make('name')
                ->required()
                ->autofocus(),

            TextInput::make('email')
                ->email()
                ->required(),

            SelectInput::make('subject')
                ->required()
                ->options([
                    'general' => 'General Inquiry',
                    'support' => 'Technical Support',
                    'sales' => 'Sales Question',
                ]),

            Textarea::make('message')
                ->required()
                ->rows(5)
                ->placeholder('Enter your message here...'),
        ]);

    expect($form)->toBeInstanceOf(Forms::class)
        ->and($form->getSchema())->toHaveCount(4);
});

test('can build a profile update form', function (): void {
    $form = Forms::make('profile-update')
        ->action('/profile')
        ->schema([
            TextInput::make('first_name')
                ->required()
                ->placeholder('First Name'),

            TextInput::make('last_name')
                ->required()
                ->placeholder('Last Name'),

            TextInput::make('bio')
                ->placeholder('Tell us about yourself'),

            DatePicker::make('birth_date')
                ->label('Date of Birth'),

            TextInput::make('website')
                ->url()
                ->placeholder('https://example.com'),
        ]);

    expect($form)->toBeInstanceOf(Forms::class)
        ->and($form->getAction())->toBe('/profile');
});

test('can build a search form with minimal configuration', function (): void {
    $form = Forms::make('search-form')
        ->action('/search')
        ->schema([
            TextInput::make('query')
                ->placeholder('Search...')
                ->autofocus()
                ->autocomplete(),
        ]);

    expect($form)->toBeInstanceOf(Forms::class)
        ->and($form->getSchema())->toHaveCount(1);
});

test('can build a numeric form for financial data', function (): void {
    $form = Forms::make('invoice-form')
        ->action('/invoices')
        ->schema([
            TextInput::make('invoice_number')
                ->required()
                ->readOnly(),

            TextInput::make('amount')
                ->numeric()
                ->required()
                ->step(0.01)
                ->prefix('$')
                ->helpText('Enter amount in USD'),

            DatePicker::make('due_date')
                ->required(),
        ]);

    expect($form)->toBeInstanceOf(Forms::class)
        ->and($form->getSchema())->toHaveCount(3);
});
