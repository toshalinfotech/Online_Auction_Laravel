@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('content')

@if ($message = Session::get('success'))
  <div class="alert alert-success">
      <p>{{ $message }}</p>
  </div>
@endif
      <h3>Your Auctions</h3>
       <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Image</th>
                    <th scope="col">Auction Starts At</th>
                    <th scope="col">Auction Ends At</th>
                    <th scope="col">Credit Per Bid</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $count = 0; 
                      $product_count = count($products_tobe_auctioned);
                      if($product_count <= 0)
                      {
                ?>
                      <tr>
                        <td scope="row" colspan="10" style="text-align:center;">List is empty!!</td>
                      </tr>
                <?php
                      }
                      else
                      {
                ?>
                      @foreach($products_tobe_auctioned as $product)
                          <tr>
                              <td scope="row"><?= $count+=1 ?></td>
                              <td scope="row">{{ $product->name }}</td>
                              <td scope="row"> <img src="{{ asset('auction-products/seller/user-id').$product->image }}" alt="{{ $product->image }}" width="50" width="50"></td>
                              <td scope="row">{{ $product->auction_started_at }}</td>
                              <td scope="row">{{ $product->auction_ends_at }}</td>
                              <td scope="row">{{ $product->credit_per_bid }}</td>
                              <td scope="row">{{ $product->created_at }}</td>
                              <td scope="row">{{ $product->updated_at }}</td>
                              <td scope="row"> <a href="{{ route('frontend.auth.seller.edit-auction',$product->id) }}">Edit</a> | <a href="{{ route('frontend.auth.seller.delete-auction',$product->id) }}" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a> </td>
                          </tr>
                      @endforeach
                <?php
                      }
                ?>
                </tbody>
              </table>
@endsection