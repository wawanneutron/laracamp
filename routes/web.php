<?php

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
Route::get('/login', function () {
    return view('auth.login-oauth');
})->name('login');
Route::get('/checkout', function () {
    return view('pages.checkout');
})->name('checkout');
Route::get('/success-checkout', function () {
    return view('pages.success-checkout');
})->name('success');
Route::get('/dashboard/laracamp', function () {
    return view('pages.dashboard.index');
})->name('dashboard-laracamp');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
