<?php

namespace App\Models\Auth\Auction;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Traits\Attribute\CreditAttribute;


class CreditPackInfo extends Model
{

    use CreditAttribute;
    //Table Name
    protected $table = 'credit_pack_infos';

    //Fillable Property

    protected $fillable = [
        'name',
        'image',
        'price',
        'unit'
    ];
    
}
