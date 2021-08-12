<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

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

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Route::get('/dashboard', [AdminController::class, 'getDashboard'])->middleware(['auth'])->name('dashboard');

Route::get('/change-password', [AdminController::class, 'getChangePassword'])->middleware(['auth'])->name(
    'changePassword'
);


require __DIR__ . '/auth.php';
