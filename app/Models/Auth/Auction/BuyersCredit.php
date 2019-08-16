<?php

namespace App\Models\Auth\Auction;

use Illuminate\Database\Eloquent\Model;

class BuyersCredit extends Model
{
    //
    protected $fillable = [
        'buyer_id',
        'total_credit'
    ];
}
