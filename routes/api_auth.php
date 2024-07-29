<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// register new user
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register');

// login user
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login');

// sent password reset link
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

// reset password
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');

// verify email by token
Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth:sanctum', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

// sent email verification link
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth:sanctum', 'throttle:6,1'])
    ->name('verification.send');

// logout user
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ->name('logout');
