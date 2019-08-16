@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('content')

@foreach ($products as $product)
@endforeach

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <h3>Update Product</h3>     
            <form method="post" action="{{ route('frontend.auth.seller.update-product',$product->id) }}" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" name="user_id" value="{{ $logged_in_user->id }}"/>

                <div class="form-group">
                    <label for="product_name">Product Name:<span class="required_field"> *</span></label>
                    <input type="text" class="form-control" name="product_name" value="{{ $product->name }}"/>
                </div>
                
                <div class="form-group">
                    <label for="product_image">Product Image:<span class="required_field"> *</span></label>
                    <input type="file" class="form-control product_image" name="product_image"/>
                    <img src="{{ asset('/auction-products/seller/user-id').$product->image }}" alt="{{ $product->image }}" width="50" width="50"    >
                </div>
                
                <div class="form-group">
                    <label for="product_description">Product Description:<span class="required_field"> *</span></label>
                    <textarea class="form-control" name="product_description" />{{ $product->description }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="product_quantity">Product Quantity:<span class="required_field"> *</span></label>
                    <input type="number" min="1" class="form-control" name="product_quantity" value="{{ $product->quantity }}"/>
                </div>
                
                <div class="form-group">
                    <label for="actual_amount">Actual Amount:<span class="required_field"> *</span></label>
                    <input type="number" min="1" class="form-control" name="actual_amount" value="{{ $product->actual_amount }}"/>
                </div>

                <div class="form-group">
                    <label for="auction_amount">Auction Amount:<span class="required_field"> *</span></label>
                    <input type="number" min="1" class="form-control" name="auction_amount" value="{{ $product->auction_amount }}"/>
                </div>

                <button type="submit" class="btn btn-primary btn_product_update">Update</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection