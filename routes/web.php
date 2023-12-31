<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContractController;

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
    return view('guest.login');
});

// Login
Route::post('/login', [LoginController::class, "authenticate"])->name('logon');

// Dashboard
Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');

// Buyer Contract
Route::get('/contract/buyer', [ContractController::class, 'getBuyerContract'])->name('contract.buyer');
Route::get('/contract/{contract}/buyer', [ContractController::class, 'showBuyer'])->name('contract.buyer-show');

// Vendor Contract
Route::get('/contract/vendor', [ContractController::class, 'getVendorContract'])->name('contract.vendor');
Route::get('/contract/{contract}/vendor', [ContractController::class, 'showVendor'])->name('contract.vendor-show');
Route::get('/contract/{contract}/edit', [ContractController::class, 'editContractDetail'])->name('contract.vendor-edit');
Route::put('/contract/{contract}/update', [ContractController::class, 'updateContractDetail'])->name('contract.vendor-update');


