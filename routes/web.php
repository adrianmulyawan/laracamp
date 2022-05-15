<?php

use App\Http\Controllers\Admin\AdminCheckoutController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\DashboardUserController;
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

// Route Group Checkout
Route::middleware(['auth'])->group(function() {
    Route::get('/checkout/success', [CheckoutController::class, 'success'])
        ->middleware(['ensureUserRole:user'])
        ->name('checkout.success');
    Route::get('/checkout/{camp:slug}', [CheckoutController::class, 'create'])
        ->middleware(['ensureUserRole:user'])       
        ->name('checkout.create');
    Route::post('/checkout/{camp}', [CheckoutController::class, 'store'])
        ->middleware(['ensureUserRole:user'])
        ->name('checkout.store');

    // Parent Dashboard (Untuk Cek Pengalihan Dashboard Apakah User Yang Login Admin/Bukan)
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');

    // Route Group Dashboard User
    Route::prefix('/dashboard/user')
        ->namespace('DashboardUser')
        ->middleware(['ensureUserRole:user'])
        ->group(function() {
            Route::get('/', [DashboardUserController::class, 'index'])
                ->name('dashboard.user');
        }
    );

    // Route Group Dashboard Admin
    Route::prefix('/dashboard/admin')
        ->namespace('DashboardAdmin')
        ->middleware(['ensureUserRole:admin'])
        ->group(function() {
            Route::get('/', [DashboardAdminController::class, 'index'])
                ->name('dashboard.admin');
            
            // Set Checkout to Paid
            Route::post('/checkout/{checkout}', [AdminCheckoutController::class, 'update'])
                ->name('admin.checkout.update');
        }
    );
});

// ============================ Socialite Routes ============================
Route::get('/auth/google/redirect', [LoginController::class, 'google'])
    ->name('user.login.google');

Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleProviderCallback'])
    ->name('user.google.callback');
// ============================ End Socialite Routes ============================

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
