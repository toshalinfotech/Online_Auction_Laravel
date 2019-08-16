@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.add_credit'))

@section('content')

<h3 class="h3">Credit Packs</h3>
<div class="row"> 
    @foreach($credit_packs as $credit_pack)
        <div class="col-md-3 col-sm-6">
            <div class="product-grid">
                <div class="product-image">
                    <a href="#">
                        <img class="pic-1" src="{{ asset('/credit_pack_images').'/'.$credit_pack->image }}">
                        <img class="pic-2" src="{{ asset('/credit_pack_images').'/'.$credit_pack->image }}">
                    </a>
                    <ul class="social">
                        <li><a href="" data-tip="Quick View"><i class="fa fa-search"></i></a></li>
                        <li><a href="" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>
                        <li><a href="" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                    
                    <span class="product-new-label">Credit Unit</span>
                    <span class="product-discount-label">{{ $credit_pack->unit }}</span>
                
                </div>
                <ul class="rating">
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star disable"></li>
                </ul>
                <div class="product-content">
                    <h3 class="title"><a href="#">{{ $credit_pack->name }}</a></h3>
                    <div class="price">&#8377; {{ $credit_pack->price }}
                        <span></span>
                    </div>
                    <a class="add-to-cart btn btn-info btn-lg" href="" data-toggle="modal" data-target="#myModal{{ $credit_pack->id }}" >+ Buy</a>
                    <!-- Make a modal for buyer to purchase credit packs  -->
                </div>
            </div>
        </div>

    <!-- Modal -->
    
    <div class="modal fade" id="myModal{{ $credit_pack->id }}" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                    <h4 class="modal-title">Your Card Details</h4>
                    <form action="{{ route('frontend.auth.buye.add-credit.buy') }}" method="post">
                            @csrf
                            <input type="hidden" name="pack_id" value="{{ $credit_pack->id }}">                    
                            <input type="hidden" name="user_id" value="{{ $logged_in_user->id }}">
                            <div class="container body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-11">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    Payment Details
                                                </h3>
                                                <div class="checkbox pull-right">
                                                    <label>
                                                        <input type="checkbox" />
                                                        Remember
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label for="cardNumber">
                                                        CARD NUMBER</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="cardNumber" id="cardNumber" class="cardNumber" placeholder="Valid Card Number" required autofocus />
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-7 col-md-7">
                                                        <div class="form-group">
                                                            <label for="expityMonth">
                                                                EXPIRY DATE</label>
                                                            <div class="col-xs-6 col-lg-6 pl-ziro">
                                                                <input type="text" class="form-control expityMonth" name="expityMonth" id="expityMonth" placeholder="MM" required />
                                                            </div>
                                                            <div class="col-xs-6 col-lg-6 pl-ziro">
                                                                <input type="text" class="form-control expityYear" 
                                                                name="expityYear" id="expityYear" placeholder="YY" required /></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-5 col-md-5 pull-right">
                                                        <div class="form-group">
                                                            <label for="cvCode">
                                                                CVV CODE</label>
                                                            <input type="password" class="form-control cvvode" name="cvvCode" id="cvvCode" placeholder="CVV" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="active"><a href="#"><span class="badge pull-right"><span class="glyphicon glyphicon-usd"></span>{{ $credit_pack->price }}</span> Final Payment</a>
                                            </li>
                                            <input type="hidden" name="pack_amount" value="{{ $credit_pack->price }}">
                                        </ul>
                                        <br/>
                                        
                                        <button class="btn btn-success btn-lg btn-block btn_pay" type="submit" role="button">Pay</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>    
    </div>
            <!-- /Modal -->

    @endforeach
</div>
@endsection