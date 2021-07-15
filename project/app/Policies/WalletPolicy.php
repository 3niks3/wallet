<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Access\HandlesAuthorization;

class WalletPolicy
{
    use HandlesAuthorization;

    public function access(User $user, Wallet $wallet)
    {
        if($user->id === $wallet->user_id) {
            return true;
        }

        return false;
    }
}
