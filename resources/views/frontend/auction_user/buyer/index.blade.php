@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.buyers_home'))

@section('content')

@if ($message = Session::get('success'))
  <div class="alert alert-success">
      <p>{{ $message }}</p>
  </div>
@endif
<!-- Loader -->
<div class="loader"> </div>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" >You Have <span class="alert alert-warning" id="credits_div"> 
        <?php
            if($credits[0]['total_credit'] <= 0)
            {
                echo "Your Credits are empty!, Can't bid.";
            }
            else
            {
                echo $credits[0]['total_credit'];
            }
        ?> 
        </span> Credits</div>
        <div class="col-md-4"> <a href="{{ route('frontend.auth.buyer.add-credit') }}"><span class="alert alert-info">Top Up Credits</span></a></div>
    </div>
    <h3 class="h3">Upcoming Products</h3>
    <div class="row">

    @foreach ($products as $product)
        <div class="col-md-3 col-sm-6">
            <div class="product-grid">
                <div class="product-image">
                    <a href="#">
                        <img class="pic-1" src="{{ asset('/auction-products/seller/user-id').$product->image }}">
                        <img class="pic-2" src="{{ asset('/auction-products/seller/user-id').$product->image }}">
                    </a>
                    <ul class="social">
                        <li><a href="" data-tip="Quick View"><i class="fa fa-search"></i></a></li>
                        <li><a href="" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>
                        <li><a href="" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                    <span class="product-new-label">Actual Price</span>
                    <span class="product-discount-label"> &#8377;{{ $product->actual_amount }}</span>
                    <span>Credit(s) Per Bid = </span> {{ $product->credit_per_bid }}
                </div>
                <ul class="rating">
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star disable"></li>
                </ul>
                <div class="product-content" id="product-content">
                    <h3 class="title"><a href="#">{{ $product->name }}</a></h3>
                    
                    <div class="price" id="auctionProductId{{ $product->id }}"> &#8377; {{ $product->auction_amount }}
                        <span class="bidding_time" id="bidding_time{{ $product->id }}" auction_ends_at="{{ $product->auction_ends_at }}" auction_id="{{ $product->id }}">

                            <span id="days{{ $product->id }}" class="days"></span>
                            <span id="hours{{ $product->id }}" class="hours"></span>    
                            <span id="minutes{{ $product->id }}" class="minutes"></span>
                            <span id="seconds{{ $product->id }}" class="seconds"></span>
                        </span>
                        
                        <span class="countdowntimer{{ $product->id }}" id="countdowntimer{{ $product->id }}"></span>
                    </div>
                    <span id="winner{{ $product->id }}" class="winner" style="display:none;">Winner : </span>
                    <span id="last_bidder_id{{ $product->id }}" class="last_bidder_id"></span>
                    <a class="start_bidding" id="start_bidding{{ $product->id }}" href="javascript:void(0);">Bid +</a>
                    <input type="hidden" name="user_id" id="user_id" class="user_id" value="{{ $logged_in_user->id }}">
                    <input type="hidden" name="total_bids" id="total_bids" class="total_bids" value="">
                    <input type="hidden" name="product_id" id="product_id{{ $product->id }}" class="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="credits_per_bid" id="credits_per_bid{{ $product->id }}" class="credits_per_bid" value="{{$product->credit_per_bid}}">
                    
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
<hr>
</div>
@endsection