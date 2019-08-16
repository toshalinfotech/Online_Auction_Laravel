@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('content')

@foreach ($auctions as $auction)
@endforeach

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <h3>Update Auction Details</h3>     
            <form method="post" action="{{ route('frontend.auth.seller.update-auction',$auction->id) }}" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" name="user_id" value="{{ $logged_in_user->id }}"/>

                <div class="form-group">
                    <label for="product_name">Product Name:<span class="required_field"> *</span></label>
                    <input type="text" class="form-control" name="product_name" value="{{ $auction->name }}" readonly/>
                </div>
                
                <div class="form-group">
                    <label for="product_image">Product Image:<span class="required_field"> *</span></label>
                    <img src="{{ asset('auction-products/seller/user-id').$auction->image }}" alt="{{ $auction->image }}" width="100" width="100" >
                </div>

            <div class="form-group">
                <label for="started_at">Auction Begins At:<span class="required_field"> *</span></label>
                <br>
                <label>Current Timing : {{ $auction->auction_started_at }} </label>
                <br>
                <div class="form-group">
                    <input type="date" name="date_started_at" id="date_started_at">
                    <input type="time" name="time_started_at" id="time_started_at">
                </div>    
            </div>
            
            <div class="form-group">
                <label for="ends_at">Auction Ends At:<span class="required_field"> *</span></label>
                <br>
                <label>Current Timing : {{ $auction->auction_ends_at }} </label>
                <br>
                <div class="form-group">
                    <input type="date" name="date_ends_at" id="date_ends_at">
                    <input type="time" name="time_ends_at" id="time_ends_at">
                </div>    
            </div>

            <div class="form-group">
                <label for="credit_per_bid">Credits Per Bid:<span class="required_field"> *</span></label>
                <input type="number" min="1" class="form-control" name="credit_per_bid" value="{{ $auction->credit_per_bid }}"/>
            </div>

                <button type="submit" class="btn btn-primary btn_auction_update">Update</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection