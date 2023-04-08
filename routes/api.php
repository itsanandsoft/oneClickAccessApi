<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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
Route::post('/signup', [UserController::class,'signup'])->middleware("guest");
Route::post('/login', [UserController::class,'login'])->middleware("guest");
Route::post('auth/forgot-password',[UserController::class,'forgot'])->middleware('guest');
Route::post('auth/reset-password',[UserController::class,'reset'])->middleware('guest');

Route::group(['middleware' => 'auth:api'], function () {
    
});
