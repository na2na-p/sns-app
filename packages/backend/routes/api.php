<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/v1')->group(function () {
    Route::prefix('/users')->group(function () {
        Route::controller(UsersController::class)->group(function () {
            Route::post('/', 'signUp');
        });
    });
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LogoutController::class, 'logout']);
    Route::middleware('sessionAuth')->group(function () {
        Route::prefix('/users')->group(function () {
            Route::controller(UsersController::class)->group(function () {
                Route::get('/me', 'findUser');
            });
        });
        Route::prefix('/messages')->group(function () {
            Route::controller(MessagesController::class)->group(function () {
                Route::post('/', 'createMessage');
                Route::get('/', 'listMessage');
                Route::put('/{messageId}/favorite', [FavoriteController::class, 'addFavorite']);
            });
        });
    });
});

