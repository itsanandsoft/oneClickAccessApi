<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'login'])->name('login');

Route::as('admin.')->prefix('admin')->group(function () {

    Route::get('/home', [DashboardController::class, 'home'])->name('home');
    Route::get('/import', [DashboardController::class, 'import'])->name('import');
    Route::post('/get_machine_data', [DashboardController::class, 'get_machine_data'])->name('get_machine_data');
    Route::post('/verify_user', [DashboardController::class, 'verify_user'])->name('verify_user');
    Route::post('/verify_machine', [DashboardController::class, 'verify_machine'])->name('verify_machine');
    Route::post('/restrict_machine', [DashboardController::class, 'restrict_machine'])->name('restrict_machine');
   
});

