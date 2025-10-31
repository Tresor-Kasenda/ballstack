<?php

declare(strict_types=1);

use Tresorkasenda\Forms\Components\TextInput;
use Tresorkasenda\Forms\Components\CheckboxInput;
use Tresorkasenda\Forms\Components\ToggleButton;
use Tresorkasenda\Forms\Components\ColorPicker;
use Tresorkasenda\Forms\Components\FileUpload;

/**
 * Feature tests demonstrating individual component usage examples.
 */

test('text input component usage for login form', function (): void {
    $username = TextInput::make('username')
        ->required()
        ->placeholder('Enter your username')
        ->autofocus()
        ->minLength(3)
        ->maxLength(50);

    $password = TextInput::make('password')
        ->password()
        ->required()
        ->minLength(8)
        ->helpText('Password must be at least 8 characters');

    expect($username->getType())->toBe('text')
        ->and($username->isRequired())->toBeTrue()
        ->and($username->getPlaceholder())->toBe('Enter your username')
        ->and($password->getType())->toBe('password')
        ->and($password->isRequired())->toBeTrue();
});

test('email input with validation configuration', function (): void {
    $email = TextInput::make('email')
        ->email()
        ->required()
        ->placeholder('your@email.com')
        ->helpText('Enter a valid email address')
        ->pattern('[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$');

    expect($email->getType())->toBe('email')
        ->and($email->isRequired())->toBeTrue()
        ->and($email->getPattern())->toContain('@');
});

test('checkbox input for terms and conditions', function (): void {
    $termsCheckbox = CheckboxInput::make('accept_terms')
        ->label('I accept the terms and conditions')
        ->required();

    expect($termsCheckbox)->toBeInstanceOf(CheckboxInput::class);
});

test('toggle button for feature flags', function (): void {
    $toggle = ToggleButton::make('notifications_enabled')
        ->label('Enable Notifications')
        ->default(true)
        ->helpText('Receive email notifications for updates');

    expect($toggle)->toBeInstanceOf(ToggleButton::class);
});

test('color picker for theme customization', function (): void {
    $colorPicker = ColorPicker::make('brand_color')
        ->label('Brand Color')
        ->default('#3490dc')
        ->helpText('Choose your brand color');

    expect($colorPicker)->toBeInstanceOf(ColorPicker::class);
});

test('file upload for profile picture', function (): void {
    $fileUpload = FileUpload::make('profile_picture')
        ->label('Profile Picture')
        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif'])
        ->maxSize(2048) // 2MB
        ->helpText('Upload a profile picture (max 2MB)');

    expect($fileUpload)->toBeInstanceOf(FileUpload::class);
});

test('numeric input for quantity selector', function (): void {
    $quantity = TextInput::make('quantity')
        ->numeric()
        ->required()
        ->step(1)
        ->minLength(1)
        ->placeholder('0')
        ->helpText('Enter quantity to purchase');

    expect($quantity->getType())->toBe('number')
        ->and($quantity->getStep())->toBe(1);
});

test('url input for website field', function (): void {
    $website = TextInput::make('website')
        ->url()
        ->placeholder('https://example.com')
        ->pattern('https?://.+')
        ->helpText('Enter a valid URL starting with http:// or https://');

    expect($website->getType())->toBe('url')
        ->and($website->getPattern())->toContain('https?://');
});

test('tel input for phone number', function (): void {
    $phone = TextInput::make('phone')
        ->tel()
        ->required()
        ->placeholder('+1 (555) 123-4567')
        ->pattern('\+?[0-9\s\-\(\)]+')
        ->helpText('Enter your phone number');

    expect($phone->getType())->toBe('tel')
        ->and($phone->isRequired())->toBeTrue();
});

test('readonly input for display-only fields', function (): void {
    $userId = TextInput::make('user_id')
        ->readOnly()
        ->helpText('This field cannot be edited');

    expect($userId->getReadOnly())->toBeTrue();
});

test('disabled input for conditional fields', function (): void {
    $disabledField = TextInput::make('disabled_field')
        ->disabled()
        ->placeholder('This field is disabled');

    expect($disabledField->isDisabled())->toBeTrue();
});

test('text input with prefix for currency', function (): void {
    $price = TextInput::make('price')
        ->numeric()
        ->prefix('$')
        ->step(0.01)
        ->placeholder('0.00')
        ->helpText('Enter price in USD');

    expect($price->getPrefix())->toBe('$')
        ->and($price->getType())->toBe('number')
        ->and($price->getStep())->toBe(0.01);
});
