<?php

use App\Http\Controllers\Admin\Users\UserController as AdminUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\SendVerificationNotificationController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Protected routes.
 */
Route::group(['middleware' => ['auth:sanctum']], function () {

    /**
     * Profile API version 1.
     */
    Route::prefix('profile/v1')->group(function () {

        /**
         * Auth routes.
         */
        Route::prefix('auth')->group(function () {
            Route::post('/verify-email/send', SendVerificationNotificationController::class)->name('verification.send');
            Route::get('/verify-email/{id}/{hash}', VerificationController::class)->name('verification.verify');
            Route::post('/forgot-password/send', ForgotPasswordController::class)->name('password.send');
            Route::post('/forgot-password/reset', ResetPasswordController::class)->name('password.reset');
            Route::post('/logout', LogoutController::class)->name('logout');
        });

        /**
         * User routes.
         */
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::patch('/{user}', [UserController::class, 'update'])->name('user.update');
        });
    });

    /**
     * Admin Panel API version 1.
     */
    Route::group(['middleware' => 'admin', 'prefix' => 'admin/v1'], function () {
        Route::prefix('users')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('users.index');
            Route::post('/create', [AdminUserController::class, 'store'])->name('user.store');
            Route::get('/{user}', [AdminUserController::class, 'show'])->name('user.show');
            Route::patch('/{user}', [AdminUserController::class, 'update'])->name('user.update');
            Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('user.destroy');
        });
    });
});

/**
 * Public routes.
 */
Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');
