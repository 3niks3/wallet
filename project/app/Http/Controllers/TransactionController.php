<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

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

    public function createAction()
    {
        dd('createAction');
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
