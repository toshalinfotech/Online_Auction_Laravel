<?php

namespace App\Http\Controllers\Frontend\Auth\UserType;

use App\Http\Controllers\Controller;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\Auth\Auction\BidMaster;

class BidMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $remaining_credits = DB::select('SELECT total_credit FROM buyers_credits WHERE buyer_id = '.$request->get('lastBidderId').' ');
        $remaining_credits = json_decode(json_encode($remaining_credits,true),true);
        if($remaining_credits[0]['total_credit'] <= 0)
        {
            DB::update('UPDATE buyers_credits SET total_credit = total_credit - 0 WHERE buyer_id = '.$request->get('lastBidderId').' ');
        }
        else
        {
            DB::update('UPDATE buyers_credits SET total_credit = total_credit - '.$request->get('creditsPerBid').' WHERE buyer_id = '.$request->get('lastBidderId').' ');
        }
        $bidmaster = new BidMaster([
            'auctioned_product_id'=>$request->get('auctionedProductId'),
            'last_bidder_id'=>$request->get('lastBidderId')
        ]);
        $bidmaster->save();
        
        $lastBidderName = DB::select('SELECT first_name FROM users WHERE id = (SELECT last_bidder_id FROM bid_master WHERE auctioned_product_id = '.$request->get('auctionedProductId').' ORDER BY id DESC LIMIT 1) ');
    }

    /**
     * Get Last Bidder Name
     */
    public function getLastBidder(Request $request)
    {
        $lastBidderName = DB::select('SELECT first_name FROM users WHERE id = (SELECT last_bidder_id FROM bid_master WHERE auctioned_product_id = '.$request->get('auctionedProductId').' ORDER BY id DESC LIMIT 1) ');

        $lastBidderName = json_decode(json_encode($lastBidderName,true),true);
        $lastBidderName = array_column($lastBidderName,'first_name');

        foreach($lastBidderName as $lastBidderNames)
        {
           print_r($lastBidderNames);
        }
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
}
