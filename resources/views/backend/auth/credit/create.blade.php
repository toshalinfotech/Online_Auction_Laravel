@extends('backend.layouts.app')

@section('title', __('labels.backend.access.auction.credit.management') . ' | ' . __('labels.backend.access.auction.credit.create'))

@section('content')

<form action="{{ route('admin.auth.credit.store') }}" method="post" enctype='multipart/form-data'>
@csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.auction.credit.management')
                        <small class="text-muted">@lang('labels.backend.access.auction.credit.management')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="name">Name</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="name" id="name" placeholder="Name" maxlength="191" required="" autofocus="">
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="image">Image</label>
                        <div class="col-md-10">
                            <input class="form-control" type="file" name=image id="image" placeholder="Image">
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="price">Price</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="price" id="price" placeholder="Price"  min="1" required="" autofocus="">
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="unit">Unit</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="unit" id="unit" placeholder="Unit" min="1" required="" autofocus="">
                        </div><!--col-->
                    </div><!--form-group-->

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.credit.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
</form>
@endsection
