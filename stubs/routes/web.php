<?php

use App\Livewire\Pages\Auth\LoginComponent;
use App\Livewire\Pages\Auth\PasswordResetComponent;
use App\Livewire\Pages\Auth\RegisterComponent;
use App\Livewire\Pages\Auth\ResetPasswordComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', LoginComponent::class)->name('login');

    Route::get('/register', RegisterComponent::class)->name('register');

    Route::get('forgot-password', PasswordResetComponent::class)
        ->name('password.request');

    Route::get('reset-password/{token}', ResetPasswordComponent::class)
        ->name('password.reset');
});

Route::middleware('auth')->group(function (): void {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
