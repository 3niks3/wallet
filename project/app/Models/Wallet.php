<?php

namespace App\Models;

use App\Service\Format;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallet';
    protected $primaryKey = 'id';

    public $timestamps = true;
    protected $guarded = ['id'];

    /****************
     * Relationships
     ****************/

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'wallet_id', 'id');
    }

    /****************
     * Accessors
     ****************/
    public function getAmountNumberFormatAttribute()
    {
        return Format::formatMoneyNumber($this->amount);
    }

    public function getAmountDecimalAttribute()
    {
        return Format::formatMoney($this->amount);
    }

    public function getTotalIncomingAmountAttribute()
    {
        return $this->transactions()->where('type','in')->sum('amount');
    }

    public function getTotalOutgoingAmountAttribute()
    {
        return $this->transactions()->where('type','out')->sum('amount');
    }

    public function getTotalBalanceAmountAttribute()
    {
        return $this->total_incoming_amount - $this->total_outgoing_amount;
    }

    public function getMaxAvailableOutgoingAmountAttribute()
    {
        $maxTransferAmount = \App\Service\TransactionValidationService::MAX_TRANSFER_AMOUNT;

        return min($maxTransferAmount, $this->amount);
    }

    /****************
     * Functions
     ****************/

    public function calculateTransactionsAmount()
    {
        $incoming = $this->transactions()->where('type','in')->sum('amount');
        $outgoing = $this->transactions()->where('type','out')->sum('amount');

        return $incoming - $outgoing;
    }

    public function updateBalance()
    {
        $this->amount =  $this->total_balance_amount;
        $this->save();
    }
}
