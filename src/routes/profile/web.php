<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\SendVerificationNotificationController;

/*
|--------------------------------------------------------------------------
| Auth API
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {
    Route::post('/verify-email/send', SendVerificationNotificationController::class)->name('verification.send');
    Route::get('/verify-email/{id}/{hash}', VerificationController::class)->name('verification.verify');
    Route::post('/forgot-password/send', ForgotPasswordController::class)->name('password.send');
    Route::post('/forgot-password/reset', ResetPasswordController::class)->name('password.reset');
    Route::post('/logout', LogoutController::class)->name('logout');
});
