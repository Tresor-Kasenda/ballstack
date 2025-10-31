<?php

declare(strict_types=1);

use Tresorkasenda\Exceptions\ModelDoesntExist;
use Tresorkasenda\Tables\Datatable;

test('datatable can be created with make method', function (): void {
    $table = Datatable::make('users-table');

    expect($table)->toBeInstanceOf(Datatable::class);
});

test('datatable can be created without name', function (): void {
    $table = Datatable::make();

    expect($table)->toBeInstanceOf(Datatable::class);
});

test('datatable throws exception for invalid model', function (): void {
    $table = Datatable::make('test-table');

    expect(fn() => $table->model(\stdClass::class))
        ->toThrow(ModelDoesntExist::class);
});

test('datatable can set fields', function (): void {
    $table = Datatable::make('test-table')
        ->fields(['name', 'email']);

    $fields = $table->getFields();

    expect($fields)->toBeArray()
        ->and($fields)->toContain('name')
        ->and($fields)->toContain('email')
        ->and($fields)->toHaveKey('actions');
});

test('datatable includes actions column by default', function (): void {
    $table = Datatable::make('test-table')
        ->fields(['name', 'email']);

    $fields = $table->getFields();

    expect($fields)->toHaveKey('actions')
        ->and($fields['actions'])->toBe('Actions');
});

test('datatable can set actions', function (): void {
    $actions = [
        'edit' => 'Edit',
        'delete' => 'Delete'
    ];

    $table = Datatable::make('test-table')->actions($actions);

    expect($table->getActions())->toBe($actions);
});

test('datatable can sort by column', function (): void {
    $table = Datatable::make('test-table')->sort('name');

    expect($table)->toBeInstanceOf(Datatable::class);
});

test('datatable can search', function (): void {
    $table = Datatable::make('test-table')->search('John');

    expect($table)->toBeInstanceOf(Datatable::class);
});

test('datatable get models returns empty array by default', function (): void {
    $table = Datatable::make('test-table');

    expect($table->getModels())->toBe([]);
});

test('datatable can be rendered to html', function (): void {
    $table = Datatable::make('test-table')
        ->fields(['name', 'email']);

    expect($table)->toBeInstanceOf(\Illuminate\Contracts\Support\Htmlable::class);
});
