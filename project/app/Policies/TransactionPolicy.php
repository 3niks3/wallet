<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function access(User $user, Transaction $transaction, Wallet $wallet)
    {
        if($wallet->id === $transaction->wallet_id) {
            return true;
        }

        return false;
    }
}
