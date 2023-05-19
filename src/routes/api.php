<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/*
 * Protected routes.
 */
Route::group(['middleware' => ['auth:sanctum']], function () {

    /*
     * Profile routes.
     */
    include(__DIR__ .'/auth/web.php');

    /*
     * Profile routes.
     */
    include(__DIR__ .'/profile/web.php');

    /*
     * Admin routes.
     */
    include(__DIR__ .'/admin/web.php');
});

/*
 * Public routes.
 */
Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');
