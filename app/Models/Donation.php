<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'amount',
        'transaction_id',
        'status',
        'payment_method',
        'reference',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];
}