<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Profile API
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'profile'], function () {
    Route::group(['prefix' => 'v1'], function () {

        /*
         * User profile routes.
         */
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::post('/{user}/update', [UserController::class, 'update'])->name('user.update');
        });
    });
});
