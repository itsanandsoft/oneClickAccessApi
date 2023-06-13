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

// Route::get('/dashboard', function () {
//     // return view('welcome');
//     return;
// });

Route::as('admin.')->prefix('admin')->group(function () {

    Route::get('/home', [DashboardController::class, 'home'])->name('home');
    Route::get('/import', [DashboardController::class, 'import'])->name('import');

});
