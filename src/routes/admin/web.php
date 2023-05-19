<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Categories\CategoryController;
use App\Http\Controllers\Admin\Posts\PostController;
use App\Http\Controllers\Admin\Users\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| Admin Panel API version 1
|--------------------------------------------------------------------------
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
            Route::post('/search', [AdminUserController::class, 'search'])->name('admin.user.search');
            Route::post('/sort', [AdminUserController::class, 'sort'])->name('admin.user.sort');
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
            Route::post('/search', [CategoryController::class, 'search'])->name('admin.category.search');
            Route::post('/sort', [CategoryController::class, 'sort'])->name('admin.category.sort');
        });
    });
});
