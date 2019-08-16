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


class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //To check weather the user is seller or not
        if ((Auth::user()->user_type) == 2) {
            $user = Auth::user();
            $products = DB::select('select * from product where user_id = '.$user->id.' ');
            return view('frontend.auction_user.seller.add_products.index', ['products' => $products]);
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
        if ((Auth::user()->user_type) == 2) {
            return view('frontend.auction_user.seller.add_products.add_products');
        } else{
            echo "<h3>Unauthorized..</h3>";
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if ((Auth::user()->user_type) == 2) {
            // To get current user info
            $user = Auth::user();

            $this->validate($request,[
                'product_name' => 'required',
                'product_image' => 'required',
                'product_description' => 'required',
                'product_quantity' => 'required',
                'actual_amount' => 'required',
                'auction_amount' => 'required'
            ]);

            $upload_path = public_path().'\auction-products\seller\user-id'.$user->id;
            if(!File::isDirectory($upload_path)){
                File::makeDirectory($upload_path, 0777, true, true);
            }
            $upload_path = public_path().'\auction-products\seller\user-id'.$user->id;
            $product_file = $request->file('product_image');
            $product_file_name = $user->id.'\\'.time().$product_file->getClientOriginalName();
            $product = new Product([
                'user_id' => $request->get('user_id'),
                'name' => $request->get('product_name'),
                'image' => $product_file_name,
                'description' => $request->get('product_description'),
                'quantity' => $request->get('product_quantity'),
                'actual_amount' => $request->get('actual_amount'),
                'auction_amount' => $request->get('auction_amount'),
            ]);
            $product_file->move($upload_path,$product_file_name);
            $product->save();
            
            return redirect()->route('frontend.auth.user-type.seller')
                            ->with('success','Product added successfully.');
        }
        else{
            echo "<h3>Unauthorized..</h3>";
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
        if ((Auth::user()->user_type) == 2) {
            $products = DB::select('select * from product where id = '.$id.' ');
            return view('frontend.auction_user.seller.add_products.edit', ['products' => $products]);
        }
        else{
            echo "<h3>Unauthorized..</h3>";
        }
        
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
        if ((Auth::user()->user_type) == 2) {
            $user = Auth::user();

            $this->validate($request,[
                'product_name' => 'required',
                'product_image' => 'required',
                'product_description' => 'required',
                'product_quantity' => 'required',
                'actual_amount' => 'required',
                'auction_amount' => 'required'
            ]);

            $upload_path = public_path().'\auction-products\seller\user-id'.$user->id;
            if(!File::isDirectory($upload_path)){
                File::makeDirectory($upload_path, 0777, true, true);
            }

            $upload_path = public_path().'\auction-products\seller\user-id'.$user->id;
            $product_file = $request->file('product_image');
            $product_file_name = $user->id.'\\'.time().$product_file->getClientOriginalName();

            $product = Product::find($id);
            $product->user_id  = $request->get('user_id');
            $product->name = $request->get('product_name');
            $product->image = $product_file_name;
            $product->description = $request->get('product_description');
            $product->quantity = $request->get('product_quantity');
            $product->actual_amount = $request->get('actual_amount');
            $product->auction_amount = $request->get('auction_amount');
            $product_file->move($upload_path,$product_file_name);
            
            $products = DB::select('select image from product where id = '.$id.' ');
            $old_image = public_path('\auction-products\seller\user-id').$products[0]->image;

            if(File::exists($old_image))
            {
                File::delete($old_image);
            }

            $product->save();
            return redirect()->route('frontend.auth.user-type.seller')
                            ->with('success','Product Updated successfully.');           
        }
        else{
            echo "<h3>Unauthorized..</h3>";
        }      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ((Auth::user()->user_type) == 2) {

            $user = Auth::user();
            $products = DB::select('select image from product where id = '.$id.' ');
            $old_image = public_path('\auction-products\seller\user-id').$products[0]->image;
            
            if(File::exists($old_image))
            {
                File::delete($old_image);
            }

            $product = Product::find($id);
            $product->delete();
            
            return redirect()->route('frontend.auth.user-type.seller')
                            ->with('success','Product Deleted successfully.');
        }
        else{
            echo "<h3>Unauthorized..</h3>";
        }   
    }

    public function indexSetAuction()
    {
        if ((Auth::user()->user_type) == 2) {
            $user = Auth::user();
            $products_tobe_auctioned = DB::select('SELECT p.name,p.image,s.* FROM set_auctions s,product p WHERE s.user_id = '.$user->id.' AND s.product_id = p.id ');

            $sellers = DB::select('SELECT id,product_id FROM set_auctions WHERE user_id = '.$user->id.' '); 

            $sellers1 = json_decode(json_encode($sellers,true),true);
            $sellers = array_column($sellers1,'id');

            $sellers_product_id = array_column($sellers1,'product_id');
            // print_r($sellers_product_id);

            foreach($sellers as $seller)
            {
                // echo $seller;
                $auction_winners = DB::select('SELECT last_bidder_id,auctioned_product_id FROM bid_master WHERE auctioned_product_id = '.$seller.' ORDER BY created_at DESC LIMIT 1');
                $auction_winners[] = $auction_winners;
            }
            
            foreach($auction_winners as $auction_winner)
            {
                $auction_win_details[] = $auction_winner;
                // $auction_winner[] = $auction_winner; 
            }
            // print_r($auction_winners);
            // die;
            
            $buyers_win_details = json_decode(json_encode($auction_win_details,true),true);
            // print_r($buyers_win_details);

            $buyers_info = array();
            foreach($buyers_win_details as $buyers_win_detail)
            {
                $buyers_info[] = $buyers_win_detail; 
            }

            // print_r(count($buyers_info));
            // print_r(array_column($buyers_info,'last_bidder_id'));

            // print_r(array_column($buyer_id,'last_bidder_id'));
            // print_r(array_column($buyer_id,'auctioned_product_id'));
                
            // die;

            // AUCTION WINNERS QUERY
            // $auction_winners = DB::select('SELECT * FROM bid_master ORDER BY created_at DESC LIMIT 1');
            
            return view('frontend.auction_user.seller.set_auction.index',['products_tobe_auctioned' => $products_tobe_auctioned,'auction_winners' => $auction_winners, 'seller' => $seller]);
        }
        else{
            echo "<h3>Unauthorized..</h3>";
        }   
    } 

    public function createSetAuction()
    {
        if ((Auth::user()->user_type) == 2) {
            $user = Auth::user();
            $products = DB::select('select id,name from product where user_id = '.$user->id.' ');
            return view('frontend.auction_user.seller.set_auction.add_auction',['products' => $products]);
        }
        else{
            echo "<h3>Unauthorized..</h3>";
        }      
    }
    
    public function storeSetAuction(Request $request)
    {
        if ((Auth::user()->user_type) == 2) {
            $this->validate($request,[
                'product_name' => 'required',
                'credit_per_bid' => 'required',
                'date_started_at' => 'required',
                'time_started_at' => 'required',
                'date_ends_at' => 'required',
                'time_ends_at' => 'required'
            ]);

            //This query is set to decrement by 1 product quantity after adding that product to auction.
            DB::update('update product set quantity = quantity - 1 where id = '.$request->get('product_name').' AND user_id = '.$request->get('user_id').' ');

            $set_auction = new SetAuction([
                'product_id' => $request->get('product_name'),
                'user_id' => $request->get('user_id'),
                'credit_per_bid' => $request->get('credit_per_bid')
            ]);
            $set_auction->auction_started_at = $request->get('date_started_at')." ".$request->get('time_started_at');
            $set_auction->auction_ends_at = $request->get('date_ends_at')." ".$request->get('time_ends_at');

            $set_auction->save();
            return redirect()->route('frontend.auth.user-type.seller.set-auction')
                             ->with('success','Auction Added Successfully.');
        }
        else{
            echo "<h3>Unauthorized..</h3>";
        }
    }

    public function editSetAuction($id)
    {
        $auctions = DB::select('select p.image,p.name,s.* from set_auctions s,product p where s.id = '.$id.' AND s.product_id = p.id ');
        return view('frontend.auction_user.seller.set_auction.edit', ['auctions' => $auctions]);
    }

    public function updateSetAuction(Request $request, $id)
    {
        if ((Auth::user()->user_type) == 2) {

            $this->validate($request,[
                'date_started_at' => 'required',
                'time_started_at' => 'required',
                'date_ends_at' => 'required',
                'time_ends_at' => 'required',
                'credit_per_bid' => 'required',
            ]);

            $set_auction = SetAuction::find($id);
            $set_auction->auction_started_at = $request->get('date_started_at')." ".$request->get('time_started_at');
            $set_auction->auction_ends_at = $request->get('date_ends_at')." ".$request->get('time_ends_at');
            $set_auction->credit_per_bid = $request->get('credit_per_bid');

            $set_auction->save();
            return redirect()->route('frontend.auth.user-type.seller.set-auction')
                            ->with('success','Auction Details Updated Successfully.');
        }
        else{
            echo "<h3>Unauthorized..</h3>";
        }

    }

    public function destroySetAuction($id)
    {
        if ((Auth::user()->user_type) == 2) {

            $set_auction = SetAuction::find($id);
            $set_auction->delete();

            return redirect()->route('frontend.auth.user-type.seller.set-auction')
                            ->with('success','Auction Deleted successfully.');
        }
        else{
            echo "<h3>Unauthorized..</h3>";
        }
    }
}