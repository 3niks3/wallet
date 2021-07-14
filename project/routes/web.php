<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WalletController;

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

Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/registration',[AuthController::class,'registration'])->name('registration');

Route::post('/registrationAction',[AuthController::class,'registrationAction'])->name('registrationAction');
Route::post('/loginAction',[AuthController::class,'loginAction'])->name('loginAction');

Route::get('/wallet',[WalletController::class, 'list'])->name('wallet');
Route::get('/wallet/create',[WalletController::class, 'create'])->name('walletCreate');
Route::get('/wallet/update/{wallet}',[WalletController::class, 'update'])->name('walletUpdate');
Route::post('/wallet/createAction',[WalletController::class, 'createAction'])->name('walletCreateAction');
Route::post('/wallet/updateAction/{wallet}',[WalletController::class, 'updateAction'])->name('walletUpdateAction');


