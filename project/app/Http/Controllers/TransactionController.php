<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use App\Service\TransactionValidationService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    public function list(Wallet $wallet)
    {
        $transactions = $wallet->transactions()->orderBy('created_at', 'desc')->orderBy('id', 'desc')->get();
        return view('transaction_list',['wallet' => $wallet, 'transactions' =>  $transactions]);

    }

    public function create(Wallet $wallet)
    {
        return view('transaction_create',['wallet' => $wallet]);
        dd('create');
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
        $amount = Transaction::formatAmount(request()->amount);

        //create transaction
        $transaction = new Transaction();
        $transaction->wallet_id = $wallet->id;
        $transaction->type = trim(request()->type);
        $transaction->amount = $amount;

        $transaction->save();

        return response()->json($validationResults);
    }

    public function markAsFraudAction()
    {
        dd('markAsFraudAction');
    }

    public function deleteAction()
    {
        dd('deleteAction');
    }
}
