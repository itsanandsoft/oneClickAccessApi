<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;

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
Route::post('admin/login',[AdminController::class,'login'])->middleware('guest');

Route::group(['middleware' => 'auth:sanctum','prefix'=>'admin'], function () {
    Route::post('verify-user',[AdminController::class,'verifyUser']);
    Route::get('get-all-users',[AdminController::class,'getAllUsers']);
    Route::get('get-all-files',[AdminController::class,'getUserFiles']);
    Route::post('upload-file',[AdminController::class,'uploadFile']);
});
Route::group(['prefix'=>'user'], function () {
    Route::post('get-all-machines',[UserController::class,'getAllMachines']);
    Route::post('get-data-agianst-user',[UserController::class,'getDataAgainstUser']);
});
