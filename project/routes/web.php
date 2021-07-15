<?php

use App\Http\Controllers\TransactionController;
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
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::group(['middleware' =>'guest:web'],function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/registration', [AuthController::class, 'registration'])->name('registration');
    Route::post('/registrationAction', [AuthController::class, 'registrationAction'])->name('registrationAction');
    Route::post('/loginAction', [AuthController::class, 'loginAction'])->name('loginAction');
});

Route::group(['middleware'=>['auth:web']],function(){
    Route::get('/wallet',[WalletController::class, 'list'])->name('wallet');
    Route::get('/wallet/create',[WalletController::class, 'create'])->name('walletCreate');


    Route::post('/wallet/createAction',[WalletController::class, 'createAction'])->name('walletCreateAction');



    //middle where check if user owns wallet
    Route::group(['middleware'=>['can:access,App\Models\Wallet,wallet']],function(){

        Route::get('/wallet/{wallet}/transactions',[TransactionController::class, 'list'])->name('transactionList');
        Route::get('/wallet/{wallet}/update',[WalletController::class, 'update'])->name('walletUpdate');
        Route::get('/wallet/{wallet}/delete',[WalletController::class, 'deleteAction'])->name('walletDeleteAction');
        Route::post('/wallet/{wallet}/updateAction',[WalletController::class, 'updateAction'])->name('walletUpdateAction');

        Route::get('/wallet/{wallet}/transactions/create',[TransactionController::class, 'create'])->name('transactionCreate');
        Route::post('/wallet/{wallet}/transactions/createAction',[TransactionController::class, 'createAction'])->name('transactionCreateAction');

        Route::group(['middleware'=>['can:access,App\Models\Transaction,transaction,wallet']],function(){
            Route::get('/wallet/{wallet}/transactions/{transaction}/fraud',[TransactionController::class, 'markAsFraudAction'])->name('transactionFraud');
            Route::get('/wallet/{wallet}/transactions/{transaction}/delete',[TransactionController::class, 'deleteAction'])->name('transactionDelete');
        });

    });




});






