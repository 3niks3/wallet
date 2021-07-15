<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use App\Service\TransactionValidationService;
use App\Service\Format;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    public function list(Wallet $wallet)
    {
        Paginator::useBootstrap();

        $lastTransaction = $wallet->transactions()->latest()->first();
        $transactions = $wallet->transactions()->orderBy('created_at', 'desc')->paginate(20);

        return view('transaction_list',['wallet' => $wallet, 'transactions' =>  $transactions, 'lastTransaction' => $lastTransaction]);
    }

    public function create(Wallet $wallet)
    {
        return view('transaction_create',['wallet' => $wallet]);
    }

    public function createAction(Wallet $wallet)
    {
        $validation = new TransactionValidationService(request()->all(), $wallet);
        $validationResults = $validation->validate();

        //return errors
        if(!$validationResults['status']) {
            return response()->json($validationResults);
        }

        //convert amount in cents
        $amount = Format::formatFormMoney(request()->amount);

        //create transaction
        $transaction = new Transaction();
        $transaction->wallet_id = $wallet->id;
        $transaction->type = trim(request()->type);
        $transaction->amount = $amount;

        $transaction->save();

        return response()->json($validationResults);
    }

    public function markAsFraudAction(Wallet $wallet, Transaction $transaction)
    {
        if($transaction->fraud == 1) {
            \Alert::success('Transaction has been Removed form Fraud status')->flash();
            $transaction->fraud = 0;
        } else {
            \Alert::success('Transaction has been Added to Fraud status')->flash();
            $transaction->fraud = 1;
        }

        $transaction->save();
        return redirect()->back();
    }

    public function deleteAction(Wallet $wallet, Transaction $transaction)
    {
        $lastTransaction = $wallet->transactions()->latest()->first();

        if($lastTransaction->id == $transaction->id) {
            $transaction->delete();

            \Alert::success('Transaction has been Deleted')->flash();
            return redirect()->back();
        }

        \Alert::error('Transaction has NOT been Deleted')->flash();
        return redirect()->back();
    }
}
