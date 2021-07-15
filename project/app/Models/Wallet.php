<?php

namespace App\Models;

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
        return number_format( ($this->amount/100), 2,'.','');
    }

    public function getAmountDecimalAttribute()
    {
        return round($this->amount /100,2);
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
}
