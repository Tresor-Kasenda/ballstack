<?php

declare(strict_types=1);

use Tresorkasenda\Forms\Components\TextInput;

test('text input can be created', function (): void {
    $input = TextInput::make('name');

    expect($input)->toBeInstanceOf(TextInput::class);
});

test('text input has default text type', function (): void {
    $input = TextInput::make('username');

    expect($input->getType())->toBe('text');
});

test('text input can be set to email type', function (): void {
    $input = TextInput::make('email')->email();

    expect($input->getType())->toBe('email');
});

test('text input can be set to password type', function (): void {
    $input = TextInput::make('password')->password();

    expect($input->getType())->toBe('password');
});

test('text input can be set to number type', function (): void {
    $input = TextInput::make('age')->numeric();

    expect($input->getType())->toBe('number');
});

test('text input can be set to tel type', function (): void {
    $input = TextInput::make('phone')->tel();

    expect($input->getType())->toBe('tel');
});

test('text input can be set to url type', function (): void {
    $input = TextInput::make('website')->url();

    expect($input->getType())->toBe('url');
});

test('text input can have placeholder', function (): void {
    $input = TextInput::make('name')->placeholder('Enter your name');

    expect($input->getPlaceholder())->toBe('Enter your name');
});

test('text input can be required', function (): void {
    $input = TextInput::make('name')->required();

    expect($input->isRequired())->toBeTrue();
});

test('text input can be disabled', function (): void {
    $input = TextInput::make('name')->disabled();

    expect($input->isDisabled())->toBeTrue();
});

test('text input can have minimum length', function (): void {
    $input = TextInput::make('username')->minLength(5);

    expect($input->getMinLength())->toBe(5);
});

test('text input can have maximum length', function (): void {
    $input = TextInput::make('username')->maxLength(20);

    expect($input->getMaxLength())->toBe(20);
});

test('text input can be set to readonly', function (): void {
    $input = TextInput::make('id')->readOnly();

    expect($input->getReadOnly())->toBeTrue();
});

test('text input can have autofocus', function (): void {
    $input = TextInput::make('search')->autofocus();

    expect($input->getAutofocus())->toBeTrue();
});

test('text input can have autocomplete', function (): void {
    $input = TextInput::make('email')->autocomplete();

    expect($input->getAutocomplete())->toBeTrue();
});

test('text input can have pattern', function (): void {
    $input = TextInput::make('zipcode')->pattern('[0-9]{5}');

    expect($input->getPattern())->toBe('[0-9]{5}');
});

test('text input can have help text', function (): void {
    $input = TextInput::make('password')->helpText('Must be at least 8 characters');

    expect($input->getHelpText())->toBe('Must be at least 8 characters');
});

test('text input can have step for numeric input', function (): void {
    $input = TextInput::make('price')->numeric()->step(0.01);

    expect($input->getStep())->toBe(0.01);
});

test('text input can have prefix', function (): void {
    $input = TextInput::make('amount')->prefix('$');

    expect($input->getPrefix())->toBe('$');
});

test('text input can chain multiple configurations', function (): void {
    $input = TextInput::make('email')
        ->email()
        ->required()
        ->placeholder('you@example.com')
        ->minLength(5)
        ->maxLength(100)
        ->autofocus()
        ->helpText('We will never share your email');

    expect($input->getType())->toBe('email')
        ->and($input->isRequired())->toBeTrue()
        ->and($input->getPlaceholder())->toBe('you@example.com')
        ->and($input->getMinLength())->toBe(5)
        ->and($input->getMaxLength())->toBe(100)
        ->and($input->getAutofocus())->toBeTrue()
        ->and($input->getHelpText())->toBe('We will never share your email');
});
