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
  // return view('welcome');
    return view('home');
});

// Auth::routes();
Auth::routes(['register' => true, 'password.request' => false, 'reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


Route::resource('deposits', App\Http\Controllers\DepositController::class);
Route::resource('withdrawals', App\Http\Controllers\WithdrawalController::class);
Route::resource('transactions', App\Http\Controllers\TransactionController::class);
Route::resource('transfers', App\Http\Controllers\TransferController::class);

Route::get('/account-statement',[App\Http\Controllers\AccountStatementController::class, 'index'])->name('account-statement');
