<?php

namespace App\Http\Controllers\Backend\Auth\AuctionUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Auth\Auction\BuyersCredit;

class AuctionUserController extends Controller
{
    public function buyersIndex ()
    {
        $buyers = DB::select('SELECT u.*,b.buyer_id,b.total_credit FROM users u, buyers_credits b WHERE u.user_type = 3 AND u.id = b.buyer_id');
        $buyers = json_decode(json_encode($buyers), true);

        return view('backend.auth.auction_users.buyers.index',['buyers' => $buyers]);
    }

    public function buyersCreate ()
    {
        return view('backend.auth.aucation_users.buyer.add_credit');
    }

    public function buyersCreateAddCredit(Request $request, $id)
    {
       return redirect()->route('admin.auth.auction-user.buyers-index');
    }

    public function buyersUpdateCredit(Request $request, $id)
    {
        DB::update('UPDATE buyers_credits SET total_credit = '.$request->get('credit').' WHERE buyer_id = '.$id.' ');
        return redirect()->route('admin.auth.auction-user.buyers-index');
    }

    public function sellersIndex ()
    {
        $total_user_products = array();
        $total_products_in_auction = array();

        $sellers = DB::select('SELECT id,first_name,last_name,email FROM users WHERE user_type = 2');
        $sellers = json_decode(json_encode($sellers), true);
        
        foreach($sellers as $seller)
        {
            $total_products = DB::select('SELECT count(user_id) AS total FROM product WHERE user_id = '.$seller['id'].' ');
            $total_products = json_decode(json_encode($total_products), true);

            $total_products_in_auction =  DB::select('SELECT count(user_id) AS total_product_in_auction FROM set_auctions WHERE user_id = '.$seller['id'].' ');
            $total_products_in_auction = json_decode(json_encode($total_products_in_auction), true);

            $total_user_products[] = array_merge($seller,$total_products,$total_products_in_auction);
        }
        
        return view('backend.auth.auction_users.sellers.index',['sellers' => $total_user_products]);
    }

    public function sellersCreate ()
    {
        
    }
}