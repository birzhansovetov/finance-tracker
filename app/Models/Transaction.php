<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'type',
        'amount',
        'category',
        'transaction_date',
        'payment_method',
        'notes',
    ];
}