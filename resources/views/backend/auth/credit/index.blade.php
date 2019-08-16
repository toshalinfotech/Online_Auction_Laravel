@extends('backend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.access.auction.credit.management'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.auction.credit.management')
                    <small class="text-muted">@lang('labels.backend.access.auction.credit.management')</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.auth.credit.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.auction.credit.table.name')</th>
                            <th>@lang('labels.backend.access.auction.credit.table.image')</th>
                            <th>@lang('labels.backend.access.auction.credit.table.price')</th>
                            <th>@lang('labels.backend.access.auction.credit.table.unit')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($credits as $credit)
                            <tr>
                                <td>{{ $credit['name'] }}</td>
                                <td><img src="{{ asset('credit_pack_images/'.$credit['image']) }}" alt="{{ $credit['image'] }}" width="50" width="50"></td>
                                <td>{{ $credit['price'] }}</td>
                                <td>{{ $credit['unit'] }}</td>
                                <td><div class="btn-group btn-group-sm" role="group" aria-label="User Actions">
                                <a href="{{ route('admin.auth.credit.edit',$credit['id']) }}" class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>

                                <a href="{{ route('admin.auth.credit.destroy',$credit['id']) }}" data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure you want to do this?" class="btn btn-danger" style="cursor:pointer;"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a> 
			                    </div></td>
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