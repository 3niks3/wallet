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
     * Accessors
     ****************/
    public function getAmountNumberFormatAttribute()
    {
        return number_format( ($this->amount/100), 2);
    }
}
