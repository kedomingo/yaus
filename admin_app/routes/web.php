<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Auth;
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
    static function () {
        if (Auth::user()) {
            return redirect(route('dashboard'));
        } else {
            return redirect(route('login'));
        }
    }
);

Route::get('/dashboard', [AdminController::class, 'getDashboard'])->middleware(['auth'])
    ->name('dashboard');
Route::get('/redirects', [AdminController::class, 'getRedirects'])->middleware(['auth'])
    ->name('redirects.index');
Route::get('/redirects/new', [AdminController::class, 'getNewRedirect'])->middleware(['auth'])
    ->name('redirects.create');
Route::get('/redirects/update/{id}', [AdminController::class, 'getEditRedirect'])->middleware(['auth'])
    ->name('redirects.update');
Route::post('/redirects/new', [AdminController::class, 'postNewRedirects'])->middleware(['auth'])
    ->name('redirects.submit');

Route::get('/change-password', [AdminController::class, 'getChangePassword'])->middleware(['auth'])->name(
    'changePassword'
);


require __DIR__ . '/auth.php';
