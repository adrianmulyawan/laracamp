<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\LoginController;
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

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/checkout/{slug}', function () {
    return view('pages.checkout');
})->name('checkout');

Route::get('/success', function () {
    return view('pages.success');
})->name('success');

// Socialite Routes
Route::get('/auth/google/redirect', [LoginController::class, 'google'])
    ->name('user.login.google');

Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleProviderCallback'])
    ->name('user.google.callback');
// End Socialite Routes

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
