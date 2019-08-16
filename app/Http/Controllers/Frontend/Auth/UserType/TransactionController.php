<?php

namespace App\Http\Controllers\Frontend\Auth\UserType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\Auction\TransactionInfo;
use App\Models\Auth\Auction\CreditPackOrder;
use DB;
use Auth;

class TransactionController extends Controller
{
    public function storeTransaction(Request $request)
    {
        $transactioninfo = new TransactionInfo();
        $transactioninfo->user_id = $request->get('user_id');
        $transactioninfo->pack_id = $request->get('pack_id');
        $transactioninfo->pack_amount = $request->get('pack_amount');
        $transactioninfo->card_number = $request->get('cardNumber');
        $transactioninfo->card_expiry_date = $request->get('expityMonth').'/'.$request->get('expityYear');
        $transactioninfo->card_cvv = $request->get('cvvCode');
        $transactioninfo->is_approved = 1;
        $transactioninfo->save();

        $transactions = DB::select('SELECT * FROM transaction_infos WHERE user_id = '.$request->get('user_id').' ORDER BY id DESC LIMIT 1');
        $transactions = json_decode(json_encode($transactions,true),true);

        DB::insert('INSERT INTO credit_pack_orders(user_type,user_id,transaction_id,credit_pack_id,amount) VALUES ('.Auth::user()->user_type.','.Auth::user()->id.','.$transactions[0]['id'].','.$transactions[0]['pack_id'].','.$transactions[0]['pack_amount'].') ');

        $orders = DB::select('SELECT credit_pack_id FROM credit_pack_orders WHERE user_id ='.Auth::user()->id.' ORDER BY id DESC LIMIT 1 ');
        $orders = json_decode(json_encode($orders,true),true);

        $creditPacks = DB::select('SELECT unit FROM credit_pack_infos WHERE id = '.$orders[0]['credit_pack_id'].' ');
        $creditPacks = json_decode(json_encode($creditPacks,true),true);

        $updateCreditsOfBuyers = DB::update('UPDATE buyers_credits SET total_credit = total_credit + '.$creditPacks[0]['unit'].' WHERE buyer_id = '.Auth::user()->id.' ');

        return redirect()->route('frontend.auth.user-type.buyer')
                            ->with('success','Payment Successfull!, Credit Pack has been added into your account.');
    }

}
