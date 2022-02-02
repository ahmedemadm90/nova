@extends('layouts.app')
@section('title')
{{__('New Driver')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
{{__('Create New Driver')}}
@endsection
@section('page-title-desc')
<hr class="w-100 bg-dark">
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('drivers.index') }}"> {{__('Back')}}</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md border-right mb-2">

        <form class="form-floating text-center col-md-8 m-auto" action="{{route('driver.store')}}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @include('layouts.errors')
            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control" id="floatingInput" placeholder="driver_name" name="name">
                <label for="floatingInput">{{__('Driver Name')}}</label>
            </div>
            <div class="form-floating m-3 m-auto">
                {{-- <input type="text" class="form-control" id="floatingInput" placeholder="License" name="license_level"> --}}
                <select class="form-control text-capitalize" name="license_level">
                    <option value="" class="" selected hidden disabled>{{__('Choose Driver License Level')}}</option>
                    <option value="1st">{{__('1st')}}</option>
                    <option value="2nd">{{__('2nd')}}</option>
                    <option value="3rd">{{__('3rd')}}</option>
                    <option value="private">{{__('private')}}</option>
                </select>
                <label for="floatingInput">{{__('Driver License')}}</label>
            </div>
            <div class="form-floating m-3 w-auto">
                <input type="number" class="form-control" id="floatingInput" placeholder="license_number"
                    name="license_number">
                <label for="floatingInput">{{__('Driver License Number')}}</label>
            </div>
            <div class="form-floating m-3 w-auto">
                <input type="number" class="form-control" id="floatingInput" placeholder="phone_number"
                    name="phone_number">
                <label for="floatingInput">{{__('Driver Phone Number')}}</label>
            </div>
            <div class="form-floating m-3 w-auto">
                <select class="form-select" name="state">
                    <option hidden selected disabled>{{__('Choose Driver State')}}</option>
                    <option value="allowed">{{__('Allowed')}}</option>
                    <option value="blacklist">{{__('Blacklist')}}</option>
                </select>
                <label for="floatingInput">{{__('Driver Company')}}</label>
            </div>
            <div class="mb-3">
                <label for="img" class="btn btn-primary">{{__('Driver ID Image')}}</label>
                <input class="form-control" type="file" id="img" style="display: none" name="img">
            </div>
            <div class="col-md-3 form-check form-switch m-auto mb-3">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked value="1"
                    name="active">
                <label class="form-check-label" for="flexSwitchCheckChecked">{{__('Active')}}</label>
            </div>
            <button class="btn btn-success text-capitalize">{{__('Add')}}</button>
        </form>
    </div>
</div>

@endsection
