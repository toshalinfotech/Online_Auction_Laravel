@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('content')

<div class="card uper">
  <div class="card-header">
    Add Your Auction Here
  </div>
  <div class="card-body">
        <form method="post" action="{{ route('frontend.auth.seller.submit-auction') }}" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label for="product_name">Product Name:<span class="required_field"> *</span></label>
                <select name="product_name" id="product_name" class="form-control">
                @foreach($products as $product)  
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
                </select>
            </div>
            <input type="hidden" name="user_id" value="{{ $logged_in_user->id }}"/>

            <div class="form-group">
                <label for="started_at">Auction Begins At:<span class="required_field"> *</span></label>
                <div class="form-group">
                    <input type="date" name="date_started_at" id="date_started_at">
                    <input type="time" name="time_started_at" id="time_started_at">
                </div>
            </div>
            
            <div class="form-group">
                <label for="ends_at">Auction Ends At:<span class="required_field"> *</span></label>
                <div class="form-group">
                    <input type="date" name="date_ends_at" id="date_ends_at">
                    <input type="time" name="time_ends_at" id="time_ends_at">
                </div>    
            </div>

            <div class="form-group">
                <label for="credit_per_bid">Credits Per Bid:<span class="required_field"> *</span></label>
                <input type="number" min="1" class="form-control" name="credit_per_bid"/>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
  </div>
</div>
@endsection