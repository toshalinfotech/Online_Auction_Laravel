@extends('backend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.access.roles.management'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.auction.seller.table.seller')
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                {{-- @include('backend.auth.role.includes.header-buttons') --}}
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">   
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.auction.seller.table.id')</th>
                            <th>@lang('labels.backend.access.auction.seller.table.name')</th>
                            <th>@lang('labels.backend.access.auction.seller.table.email')</th>
                            <th>@lang('labels.backend.access.auction.seller.table.total_products')</th>
                            <th>@lang('labels.backend.access.auction.seller.table.total_products_in_auction')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sellers as $seller)
                            <tr>
                                <td>{{ $seller['id'] }}</td>
                                <td>{{ $seller['first_name'] }} {{ $seller['last_name'] }}</td>
                                <td>{{ $seller['email'] }}</td>
                                <td>{{ $seller[0]['total'] }}</td>
                                <td>{{ $seller[1]['total_product_in_auction'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection