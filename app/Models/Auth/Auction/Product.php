<?php

namespace App\Models\Auth\Auction;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Table Name
    protected $table = 'product';

    //Fillable Property

    protected $fillable = [
        'user_id',
        'name',
        'image',
        'description',
        'quantity',
        'actual_amount',
        'auction_amount'
    ];

    // public $timestamps = true;

}
