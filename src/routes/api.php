<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SendVerificationNotificationController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {

    /**
     * Protected routes.
     */
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    /**
     * Profile API version 1.
     */
    Route::prefix('profile/v1')->group(function () {
        Route::prefix('user')->group(function () {
            Route::post('/verify-email/send', VerificationController::class)->name('verification.send');
            Route::post('/verify-email/{id}/{hash}', SendVerificationNotificationController::class)->name('verification.verify');
            Route::post('/forgot-password/send', ForgotPasswordController::class)->name('password.send');
            Route::post('/forgot-password/reset', ResetPasswordController::class)->name('password.reset');
            Route::post('/logout', LogoutController::class)->name('logout');
        });
    });
});

/**
 * Public routes.
 */
Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');
