<?php

namespace App\Models\Auth\Auction;

use Illuminate\Database\Eloquent\Model;

class CreditPackOrder extends Model
{
    protected $table = 'credit_pack_orders';

    protected $fillable = [
        'user_type',
        'user_id',
        'credit_pack_id',
        'price'
    ];
}
