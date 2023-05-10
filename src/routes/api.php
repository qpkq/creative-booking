<?php

use App\Http\Controllers\Admin\Categories\CategoryController;
use App\Http\Controllers\Admin\Posts\PostController;
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

/*
 * Protected routes.
 */
Route::group(['middleware' => ['auth:sanctum']], function () {

    /*
     * Profile API version 1.
     */
    Route::group(['prefix' => 'profile'], function () {
        Route::group(['prefix' => 'v1'], function () {

            /*
             * Auth routes.
             */
            Route::prefix('auth')->group(function () {
                Route::post('/verify-email/send', SendVerificationNotificationController::class)->name('verification.send');
                Route::get('/verify-email/{id}/{hash}', VerificationController::class)->name('verification.verify');
                Route::post('/forgot-password/send', ForgotPasswordController::class)->name('password.send');
                Route::post('/forgot-password/reset', ResetPasswordController::class)->name('password.reset');
                Route::post('/logout', LogoutController::class)->name('logout');
            });

            /*
             * User profile routes.
             */
            Route::group(['prefix' => 'user'], function () {
                Route::get('/', [UserController::class, 'index'])->name('user.index');
                Route::post('/{user}/update', [UserController::class, 'update'])->name('user.update');
            });
        });
    });

    /*
     * Admin Panel API version 1.
     */
    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
        Route::group(['prefix' => 'v1'], function () {

            /*
             * Users routes.
             */
            Route::group(['prefix' => 'users'], function () {
                Route::get('/', [AdminUserController::class, 'index'])->name('admin.users.index');
                Route::post('/create', [AdminUserController::class, 'store'])->name('admin.user.store');
                Route::get('/{user}', [AdminUserController::class, 'show'])->name('admin.user.show');
                Route::post('/{user}/update', [AdminUserController::class, 'update'])->name('admin.user.update');
                Route::post('/{user}/delete', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');
            });

            /*
             * Post routes.
             */
            Route::group(['prefix' => 'posts'], function () {
                Route::get('/', [PostController::class, 'index'])->name('admin.post.index');
                Route::post('/create', [PostController::class, 'store'])->name('admin.post.store');
                Route::get('/deleted', [PostController::class, 'showDeletedPosts'])->name('admin.posts.deleted');
                Route::get('/{post}', [PostController::class, 'show'])->name('admin.post.show');
                Route::post('/{post}/update', [PostController::class, 'update'])->name('admin.post.update');
                Route::get('/{post}/delete', [PostController::class, 'destroy'])->name('admin.post.destroy');
                Route::post('/{id}/restore', [PostController::class, 'restore'])->name('admin.post.restore');
                Route::post('/search', [PostController::class, 'search'])->name('admin.post.search');
                Route::post('/sort', [PostController::class, 'sort'])->name('admin.post.sort');
            });

            /*
             * Categories routes.
             */
            Route::group(['prefix' => 'categories'], function () {
                Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
                Route::post('/create', [CategoryController::class, 'store'])->name('admin.category.store');
                Route::get('/{category}', [CategoryController::class, 'show'])->name('admin.category.show');
                Route::post('/{category}/update', [CategoryController::class, 'update'])->name('admin.category.update');
                Route::post('/{category}/delete', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
            });
        });
    });
});

/*
 * Public routes.
 */
Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');
