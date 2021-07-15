<?php

namespace App\Models;

use App\Service\Format;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';
    protected $primaryKey = 'id';

    public $timestamps = true;
    protected $guarded = ['id'];

    /****************
     * Relationships
     ****************/

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'id', 'wallet_id');
    }

    /****************
     * Accessors
     ****************/
    public function getAmountNumberFormatAttribute()
    {
        return Format::formatMoneyNumber($this->amount);
    }

    /****************
     * Functions
     ****************/

    public function updateWalletBalance()
    {
        $wallet = $this->wallet;

        $wallet->amount = $wallet->total_balance_amount;
        $wallet->save();
    }
}
