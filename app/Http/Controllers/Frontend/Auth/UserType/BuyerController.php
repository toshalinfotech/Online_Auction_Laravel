<?php

namespace App\Http\Controllers\Frontend\Auth\UserType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models;
use App\Models\Auth\Auction\Product;
use App\Models\Auth\Auction\SetAuction;
use Auth;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Auth\Auction\CreditPackInfo;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ((Auth::user()->user_type) == 3) 
        {
            $user = Auth::user();
            $products_tobe_auctioned = DB::select(' SELECT s.id, s.auction_started_at, s.auction_ends_at, s.credit_per_bid, p.name, p.image, p.description, p.actual_amount, p.auction_amount FROM set_auctions s, product p WHERE p.id = s.product_id ');
            
            $credits = DB::select(' SELECT total_credit FROM buyers_credits WHERE buyer_id = '.$user->id.' ');
            $credits = json_decode(json_encode($credits), true);

            return view('frontend.auction_user.buyer.index',['products' => $products_tobe_auctioned , 'credits' => $credits]);
        }
        else
        {
            echo "<h3>Unauthorized..</h3>";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add_credit_index()
    {
        $credit_packs = DB::select(' SELECT * FROM credit_pack_infos ORDER BY created_at ASC ');
        return view('frontend.auction_user.buyer.add_credit',['credit_packs' => $credit_packs]);
    }
}