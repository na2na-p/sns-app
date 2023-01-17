<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/v1/users', [UsersController::class, 'whoAmI']);
Route::post('/v1/users', [UsersController::class, 'signUp']);
Route::put('/v1/users/{userId}', [UsersController::class, 'updateUser']);
Route::post('/v1/login', [LoginController::class, 'login']);
Route::post('/v1/logout', [LogoutController::class, 'logout']);
