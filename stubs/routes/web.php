<?php

declare(strict_types=1);

use App\Livewire\Pages\Auth\ConfirmPassword;
use App\Livewire\Pages\Auth\LoginComponent;
use App\Livewire\Pages\Auth\PasswordResetComponent;
use App\Livewire\Pages\Auth\RegisterComponent;
use App\Livewire\Pages\Auth\ResetPasswordComponent;
use App\Livewire\Pages\Auth\VerifyEmail;
use App\Livewire\Pages\Profile\UserProfile;
use App\Livewire\Pages\Setting\AccountSetting;
use App\Livewire\Pages\Welcome;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('dashboard', Welcome::class)->name('dashboard');
    Route::get('profile', UserProfile::class)->name('profile');
    Route::get('setting', AccountSetting::class)->name('setting');
});


Route::middleware('guest')->group(function (): void {
    Route::get('/login', LoginComponent::class)->name('login');

    Route::get('/register', RegisterComponent::class)->name('register');

    Route::get('forgot-password', PasswordResetComponent::class)
        ->name('password.request');

    Route::get('reset-password/{token}', ResetPasswordComponent::class)
        ->name('password.reset');
});

Route::middleware('auth')->group(function (): void {

    Route::get('confirm-password', ConfirmPassword::class)
        ->name('password.confirm');

    Route::get('verify-email', VerifyEmail::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmail::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});
