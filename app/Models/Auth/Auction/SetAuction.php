<?php

namespace App\Models\Auth\Auction;

use Illuminate\Database\Eloquent\Model;

class SetAuction extends Model
{
     //Table Name
     protected $table = 'set_auctions';

     //Fillable Property
 
     protected $fillable = [
         'product_id',
         'user_id',
         'auction_started_at',
         'auction_ends_at',
         'credit_per_bid',
     ];
 
     // public $timestamps = true;
}
