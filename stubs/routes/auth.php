<?php

declare(strict_types=1);

use App\Livewire\Pages\Auth\ConfirmPassword;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\PasswordReset;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\Auth\ResetPassword;
use App\Livewire\Pages\Auth\VerifyEmail;
use App\Livewire\Pages\Profile\UpdatePassword;
use App\Livewire\Pages\Profile\UpdateProfile;
use App\Livewire\Pages\Profile\UserProfile;
use App\Livewire\Pages\Setting\AccountSetting;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::get('/login', Login::class)->name('login');

    Route::get('/register', Register::class)->name('register');

    Route::get('forgot-password', PasswordReset::class)
        ->name('password.request');

    Route::get('reset-password/{token}', ResetPassword::class)
        ->name('password.reset');
});

Route::middleware(['auth', 'verified'])->group(function (): void {

    Route::get('confirm-password', ConfirmPassword::class)
        ->name('password.confirm');

    Route::get('verify-email', VerifyEmail::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmail::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::get('profile', UserProfile::class)->name('profile');
    Route::get('update-profile', UpdateProfile::class)->name('update-profile');
    Route::get('profile/update-password', UpdatePassword::class)->name('update-password');

    Route::get('setting', AccountSetting::class)->name('setting');
});
