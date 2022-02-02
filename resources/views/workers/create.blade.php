@extends('layouts.app')
@section('title')
{{__('New Worker')}}
@endsection
@section('page-title')
{{__('Add New Worker')}}
@endsection
@section('page-title-desc')
{{__('Add New Employee / Worker')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="w-100 bg-dark">
<div class="row m-2">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('workers.index') }}">{{__('Back')}}</a>
        </div>
    </div>
</div>

<div class="container text-capitalize text-center" style="font-family: sans-serif">
    @include('layouts.errors')
    <form class="row m-auto text-center" action="{{route('worker.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row m-auto p-1">
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="number" class="form-control" name="id" placeholder="hr or national id">
                    <label for="floatingInputGrid">{{__('iD number')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="text" class="form-control" name="name" placeholder="name">
                    <label for="floatingInputGrid">{{__('name')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="text" class="form-control" name="position" placeholder="job">
                    <label for="floatingInputGrid">{{__('position')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select name="title_id" id="title" class="form-select text-capitalize">
                        <option value="" class="text-capitalize" selected hidden>{{__('choose worker title')}}</option>
                        @foreach ($titles as $title)
                        <option value="{{$title->id}}">{{$title->title_name}}</option>
                        @endforeach
                    </select>
                    <label for="floatingInputGrid">{{__('title')}}</label>
                </div>
            </div>
        </div>
        <div class="row m-auto p-1">
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select name="vp_id" id="vp" class="form-select text-capitalize">
                        <option value="" selected hidden>{{__('select worker vP')}}</option>
                        @foreach ($vps as $vp)
                        <option value="{{$vp->id}}">{{$vp->vp_name}}</option>
                        @endforeach
                    </select>
                    <label for="floatingInputGrid">{{__('Choose Worker VP')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select name="area_id" id="area" class="form-select text-capitalize" disabled>
                        <option selected hidden class="text-capitalize">{{__('choose area')}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('Choose Worker Area')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select name="country_id" id="country" class="form-select text-capitalize">
                        <option value="" selected hidden>{{__('select worker Country')}}</option>
                        @foreach ($countries as $country)
                        <option value="{{$country->id}}">{{$country->country_name}}</option>
                        @endforeach
                    </select>
                    <label for="floatingInputGrid">{{__('Choose Worker Country')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select name="location_id" id="location" class="form-select text-capitalize" disabled>
                        <option selected hidden class="text-capitalize">{{__('choose Location')}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('Choose Worker Location')}}</label>
                </div>
            </div>
        </div>
        <div class="row m-auto p-1">

            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select class="form-select text-capitalize" name="type_id">
                        <option value="" hidden selected>{{__('worker type')}}</option>
                        @foreach ($types as $type)
                        <option value="{{$type->id}}">{{$type->type_name}}</option>
                        @endforeach
                    </select>
                    <label for="floatingInputGrid">{{__('worker type')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select name="company_id" class="form-control text-capitalize">
                        <option selected disabled hidden>{{('Select Company')}}</option>
                        @foreach ($companies as $company)
                        <option value="{{$company->id}}">{{$company->company_name}}
                        </option>
                        @endforeach
                    </select>
                    <label for="floatingInputGrid">{{__('worker company')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select class="form-select text-capitalize" name="state">
                        <option class="" hidden selected>worker state</option>
                        <option class='' value="allowed">allowed</option>
                        <option class='' value="suspended">suspended</option>
                        <option class='' value="blacklisted">blacklisted</option>
                    </select>
                    <label for="floatingInputGrid">worker state</label>
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <input class="form-control" type="file" name="img" accept=".jpg, .png, .jpeg, .gif|image/*">
            </div>
        </div>
        <div class="row m-auto p-1">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="worker_manager_id" class="form-select text-capitalize">
                        <option value="" selected hidden>{{__('choose manager')}}</option>
                        @foreach ($admins as $admin)
                        <option value="{{$admin->id}}">{{$admin->name}}</option>
                        @endforeach
                    </select>
                    <label for="floatingInputGrid">{{__('worker Manager')}}</label>
                </div>
            </div>
            <div class="form-check form-check-inline form-switch col-md text-capitalize mt-3 m-2">
                <input class="form-check-input btn-lg" type="checkbox" name="area_res" value="1">
                <label class="form-check-label">{{ __('Area Responsible') }}</label>
            </div>
        </div>
        <div class="col-md m-auto mt-2 p-1">
            @can('User Create')
            <div class="form-floating">
                <button type="submit" class="btn btn-success text-capitalize">
                    {{__('add worker')}}
                </button>
            </div>
            @endcan
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on('change', '#vp', function() {
            $('#area').find('option')
            .remove();
            console.log($(this).val());
            var vp_id = $(this).val();
            $.ajax({
                type: 'get'
                , url: "{{route('findvpareas')}}"
                , data: {
                    "id": vp_id
                }
                , dataType: 'json'
                , success: function(data) {
                    $('#area').removeAttr("disabled");
                    var selectArea = '';
                    data.forEach(function(row) {
                        $('#area').find('option')
                            .remove();
                        selectArea += '<Option value=' + row.id + '>' + row.area_name + '</Option>';
                        $('#area').append(selectArea);
                    });
                    console.log(data.length);
                }
                , error: function() {
                }
            , });
            $('#area').append();
        });
    });
    $(document).ready(function() {
        $(document).on('change', '#country', function() {
            $('#location').find('option')
            .remove();
            /* console.log($(this).val()); */
            var country_id = $(this).val();
            $.ajax({
                type: 'get'
                , url: "{{route('findlocations')}}"
                , data: {
                    "id": country_id
                }
                , dataType: 'json'
                , success: function(data) {
                    $('#location').removeAttr("disabled");
                    var selectLocation = '';
                    data.forEach(function(row) {
                        $('#location').find('option')
                            .remove();
                        selectLocation += '<Option value=' + row.id + '>' + row.location_name + '</Option>';
                        $('#location').append(selectLocation);
                    });
                    //console.log(data.length);
                }
                , error: function() {
                }
            , });
            $('#location').append();
        });
    });
</script>

@endsection
