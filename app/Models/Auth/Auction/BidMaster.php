<?php

namespace App\Models\Auth\Auction;

use Illuminate\Database\Eloquent\Model;

class BidMaster extends Model
{
    //Table Name
    protected $table = 'bid_master';

    //Fillable Property
    protected $fillable = [
        'auctioned_product_id',
        'last_bidder_id',
    ];
}
