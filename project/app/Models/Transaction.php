<?php

namespace App\Models;

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
        return number_format( ($this->amount/100), 2);
    }

    /****************
     * Functions
     ****************/

    public function updateWalletBalance()
    {
        $wallet = $this->wallet;

        $wallet->amount = $wallet->calculateTransactionsAmount();
        $wallet->save();
    }

    public static function formatAmount($amount)
    {
        return floor($amount *100);
    }
}
