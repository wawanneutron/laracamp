<?php

use App\Http\Controllers\Admin\CheckoutController as AdminCheckoutController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// login socialite
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::get('/sign-in-google', [UserController::class, 'google'])->name('user.login.google')->middleware('guest');
Route::get('/auth/google/callback', [UserController::class, 'handleGoogleCallback'])->name('google.callback')->middleware('guest');

// midtrans routes
Route::get('payment/success', [CheckoutController::class, 'midtransCallback']);
Route::post('payment/success', [CheckoutController::class, 'midtransCallback']);

/**
 * Route Middleware
 */
Route::middleware(['auth'])->group(function () {
    Route::get('checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('user.checkout')->middleware('ensureUserRole:user');
    Route::post('checkout/{camp:slug}', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('ensureUserRole:user');
    Route::get('success-checkout', [CheckoutController::class, 'successCheckout'])->name('success.checkout')->middleware('ensureUserRole:user');
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard-laracamp');
    // user dashboard
    Route::prefix('user/dashboard')->namespace('User')->name('user.')
        ->middleware('ensureUserRole:user')
        ->group(function () {
            Route::get('/', [UserDashboard::class, 'index'])->name('dashboard');
        });

    // admin dashboard
    Route::prefix('admin/dashboard')->namespace('Admin')->name('admin.')
        ->middleware('ensureUserRole:admin')
        ->group(function () {
            Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
            // admin checkout
            Route::post('checkout/set-to-paid/{checkout}', [AdminCheckoutController::class, 'updatePaid'])->name('update.paid');
            Route::post('checkout/cancle-to-paid/{checkout}', [AdminCheckoutController::class, 'updatePaid'])->name('update.cancle');
        });
});

require __DIR__ . '/auth.php';
