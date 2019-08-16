@extends('backend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.access.roles.management'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.auction.buyer.table.buyer')
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
                            <th>@lang('labels.backend.access.auction.buyer.table.id')</th>
                            <th>@lang('labels.backend.access.auction.buyer.table.name')</th>
                            <th>@lang('labels.backend.access.auction.buyer.table.email')</th>
                            <th>@lang('labels.backend.access.auction.buyer.table.credits_remaining')</th>
                            <th>@lang('labels.general.add_credit')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(empty(count($buyers)))
                        {
                        ?>
                            <tr>
                                <td style="text-align:center" colspan="5"> List Is Empty </td>  
                            </tr>
                        <?php
                        }else{
                        ?>
                        @foreach($buyers as $buyer)
                            <tr>
                                <td>{{ $buyer['id'] }}</td>
                                <td>{{ $buyer['first_name'] }} {{ $buyer['last_name'] }}</td>
                                <td>{{ $buyer['email'] }}</td>
                                <td><?php if($buyer['total_credit']<=0){echo "0";} ?>{{ $buyer['total_credit'] }}</td>
                                <td><button class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal{{ $buyer['id'] }}"> + </button></td>
                            </tr>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="myModal{{ $buyer['id'] }}" role="dialog">
                            <div class="modal-dialog">
            
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                <h4 class="modal-title">Add Credits</h4>
                                </div>
                                <form action="{{ route('admin.auth.auction-user.buyers-index.update-credit',$buyer['buyer_id']) }}" method="post">
                                @csrf
                                    <div class="modal-body">
                                        <input type="number" min="0" name="credit">
                                        <input type="hidden" value="{{ $buyer['id'] }}" name="buyer_id">
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            
                            </div>
                        </div>
                        <!-- /Modal -->
                        @endforeach
                        <?php
                        }
                        ?>
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