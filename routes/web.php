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
Route::get('/logout', [LoginController::class, "logout"])->name('logout');

// Dashboard
Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');

// Buyer Contract
Route::get('/contract/buyer', [ContractController::class, 'getBuyerContract'])->name('contract.buyer');
Route::get('/contract/{contract}/buyer', [ContractController::class, 'showBuyer'])->name('contract.buyer-show');
Route::get('/contract/detail/{contract}/vendor/{vendor}', [ContractController::class, 'detailBuyer'])->name('contract.buyer-detail');
Route::post('/contract/detail/{contract}/vendor/{vendor}/return', [ContractController::class, 'return'])->name('contract.buyer-return');
Route::post('/contract/detail/{contract}/vendor/{vendor}/review', [ContractController::class, 'reviewLegal'])->name('contract.buyer-reviewLegal');


// Vendor Contract
Route::get('/contract/vendor', [ContractController::class, 'getVendorContract'])->name('contract.vendor');
Route::get('/contract/{contract}/vendor', [ContractController::class, 'showVendor'])->name('contract.vendor-show');
Route::get('/contract/{contract}/edit', [ContractController::class, 'editContractDetail'])->name('contract.vendor-edit');
Route::put('/contract/{contract}/update', [ContractController::class, 'updateContractDetail'])->name('contract.vendor-update');


//Legal Contract
Route::get('/contract/legal', [ContractController::class, 'getLegalContract'])->name('contract.legal');
Route::get('/contract/{contract}/legal', [ContractController::class, 'showLegal'])->name('contract.legal-show');
Route::post('/contract/{contract}/approval', [ContractController::class, 'storeReview'])->name('contract.legal-approval');
Route::get('/contract/{contract}/legal/edit', [ContractController::class, 'editLegal'])->name('contract.legal-edit');



