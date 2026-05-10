<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OperationalCost extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'date',
        'category',
        'notes'
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2'
    ];
}