<?php

namespace App\Models\Auth\Auction;

use Illuminate\Database\Eloquent\Model;

class TransactionInfo extends Model
{
    //Table Name
    protected $table = 'transaction_infos';

    //Fillable Property

    protected $fillable = [
        'pack_amount',
        'card_number',
        'card_exipery_date',
        'card_cvv',
        'is_approved',
    ];
}
