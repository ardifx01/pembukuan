<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [

        'invoice_number',
        'user_id',
        'reseller_id',
        'customer_name',

        'type',

        'subtotal',
        'discount',
        'tax',
        'total',

        'paid',
        'change',

        'payment_method',
        'payment_status',
        'remaining_debt',

        'status',
        'transaction_date',
        'notes'
    ];

    protected $casts = [
        'transaction_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}