<?php

use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('pages.home');
})->name('home');
// login socialite
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/sign-in-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('/auth/google/callback', [UserController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('user.checkout');
Route::post('checkout/{camp:slug}', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('success-checkout', [CheckoutController::class, 'successCheckout'])->name('success.checkout');

Route::get('/dashboard/laracamp', function () {
    return view('pages.dashboard.index');
})->name('dashboard-laracamp');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
