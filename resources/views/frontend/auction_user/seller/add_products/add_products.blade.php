@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('content')

{{-- 
@if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
@endif
--}}

<div class="card uper">
  <div class="card-header">
    Add Product
  </div>
  <div class="card-body">
        <form method="post" action="{{ route('frontend.auth.seller.submit-product') }}" enctype="multipart/form-data" >
            @csrf

                <input type="hidden" name="user_id" value="{{ $logged_in_user->id }}"/>

            <div class="form-group">
                <label for="product_name">Product Name:<span class="required_field"> *</span></label>
                <input type="text" class="form-control" name="product_name"/>
            </div>
            
            <div class="form-group">
                <label for="product_image">Product Image:<span class="required_field"> *</span></label>
                <input type="file" class="form-control" name="product_image"/>
            </div>
            
            <div class="form-group">
                <label for="product_description">Product Description:<span class="required_field"> *</span></label>
                <textarea class="form-control" name="product_description"/></textarea>
            </div>
            
            <div class="form-group">
                <label for="product_quantity">Product Quantity:<span class="required_field"> *</span></label>
                <input type="number" min="1" class="form-control" name="product_quantity"/>
            </div>
            
            <div class="form-group">
                <label for="actual_amount">Actual Amount:<span class="required_field"> *</span></label>
                <input type="number" min="1" class="form-control" name="actual_amount"/>
            </div>

            <div class="form-group">
                <label for="auction_amount">Auction Amount:<span class="required_field"> *</span></label>
                <input type="number" min="1" class="form-control" name="auction_amount"/>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
  </div>
</div>
@endsection