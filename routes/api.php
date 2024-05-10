<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
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


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('posts', PostController::class);
    Route::put('posts/hide/{id}', [PostController::class , 'hidePost']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::group(['prefix' => 'lookups'], function () {
        Route::get('users', [UserController::class , 'userLookups']);
    });
});
Route::post('login', [AuthController::class, 'login']);
