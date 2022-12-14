<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/login', [AuthenticationController::class, 'index'])->name('login.view');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.login');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('login.logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register.view');
Route::post('/register', [RegisterController::class, 'register'])->name('register.register');

Route::get('/wallet/fiat', [WalletController::class, 'fiat'])->name('wallet.fiat');
Route::get('/wallet/funding', [WalletController::class, 'funding'])->name('wallet.funding');
Route::get('/wallet/history', [WalletController::class, 'history'])->name('wallet.history');

Route::get('/order/{action}/{id}', [OrderController::class, 'index'])->name('order.view');
Route::post('/order/{action}/{id}', [OrderController::class, 'transaction'])->name('order.transaction');
