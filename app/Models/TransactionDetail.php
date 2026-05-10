<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id', 'furniture_id', 'quantity', 
        'price', 'base_price', 'subtotal'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }
}