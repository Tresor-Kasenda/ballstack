<?php

declare(strict_types=1);

use App\Livewire\Pages\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('home');

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('dashboard', Welcome::class)->name('dashboard');
});

require 'auth.php';
