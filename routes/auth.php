<?php

declare(strict_types=1);

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\PromptEmailVerificationController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SendEmailVerificationController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register.create');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::delete('login', [AuthenticatedSessionController::class, 'destroy'])->name('login.destroy');
    Route::post('/email/verification-notification', SendEmailVerificationController::class)
        ->middleware('throttle:6,1')->name('verification.send');
    Route::get('/email/verify', PromptEmailVerificationController::class)->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
});
