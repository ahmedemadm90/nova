@extends('layouts.app')
@section('title')
{{$dvr->name}} || {{__('Info')}}
@endsection
@section('page-title')
{{__('Record Device')}} || <span class="text-danger">{{$dvr->name}}</span> || {{__('Info')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="w-100 bg-dark">
<div class="container text-capitalize text-center" style="font-family: sans-serif">
    @include('layouts.errors')
    <div class="row m-2">
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" name="name" class="form-control text-capitalize" placeholder="Device Name"
                    value="{{$dvr->name}}" disabled>
                <label class="text-capitalize">{{__('Name')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" name="name" class="form-control text-capitalize" placeholder="Device Name"
                    value="{{$dvr->type}}" disabled>
                <label class="text-capitalize">{{__('Choose Device Type')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="date" name="installation_date" class="form-control text-capitalize" placeholder="From"
                    value="{{$dvr->installation_date}}" disabled>
                <label class="text-capitalize">{{__('installation date')}}</label>
            </div>
        </div>
    </div>
    <div class="row m-2">
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" name="region" class="form-control text-capitalize" placeholder="Device Name"
                    value="{{$dvr->region}}" disabled>
                <label class="text-capitalize">{{__('region')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <div class="form-floating">
                    <input type="text" name="location" class="form-control text-capitalize" placeholder="Device Name"
                        value="{{$dvr->location}}" disabled>
                    <label class="text-capitalize">{{__('location')}}</label>
                </div>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" name="area" class="form-control text-capitalize" placeholder="From"
                    value="{{$dvr->area}}" disabled>
                <label class="text-capitalize">{{__('area')}}</label>
            </div>
        </div>
    </div>
    <div class="row m-2">
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" name="brand" class="form-control text-capitalize" placeholder="Device Name"
                    value="{{$dvr->brand}}" disabled>
                <label class="text-capitalize">{{__('brand')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" name="model" class="form-control text-capitalize" placeholder="Device Name"
                    value="{{$dvr->model}}" disabled>
                <label class="text-capitalize">{{__('model')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" name="sw_ver" class="form-control text-capitalize" placeholder="Device Name"
                    value="{{$dvr->sw_ver}}" disabled>
                <label class="text-capitalize">{{__('software version')}}</label>
            </div>
        </div>

    </div>
    <div class="row m-2">
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" name="code" class="form-control text-capitalize" placeholder="code"
                    value="{{$dvr->code}}" disabled>
                <label class="text-capitalize">{{__('code')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="number" name="total_chs" class="form-control text-capitalize" placeholder="Total Channels"
                    value="{{$dvr->total_chs}}" disabled>
                <label class="text-capitalize">{{__('total channels')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="number" name="hdd_cap" class="form-control text-capitalize"
                    placeholder="How Many HDDs Fit Inside" value="{{$dvr->hdd_cap}}" disabled>
                <label class="text-capitalize">{{__('HDDs Max Count')}}</label>
            </div>
        </div>
    </div>
    <div class="row m-2">
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="number" name="unit_cap" class="form-control text-capitalize" placeholder="HDDs Count"
                    value="{{$dvr->unit_cap}}" disabled>
                <label class="text-capitalize">{{__('Max Capacity Per HDD')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="number" name="total_storage" class="form-control text-capitalize"
                    placeholder="total storage" value="{{$dvr->total_storage}}" disabled>
                <label class="text-capitalize">{{__('total storage')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="number" name="qty" class="form-control text-capitalize" placeholder="total storage"
                    value="{{$dvr->qty}}" disabled>
                <label class="text-capitalize">{{__('Quantity')}}</label>
            </div>
        </div>
    </div>
    <div class="row m-2">
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" name="ip" class="form-control text-capitalize" placeholder="HDDs Count"
                    value="{{$dvr->ip}}" disabled>
                <label class="text-capitalize">{{__('device ip')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" name="username" class="form-control" placeholder="total storage" autocomplete="false"
                    value="{{$dvr->username}}" disabled>
                <label class="text-capitalize">{{__('username')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" name="password" class="form-control" placeholder="total storage"
                    value="{{$dvr->password}}" disabled>
                <label class="text-capitalize">{{__('password')}}</label>
            </div>
        </div>
    </div>
    <div class="row m-2">
        <div class="col-md-2 form-check form-switch m-auto fs-3">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" value="1" name="active"
                @if($dvr->active ==1)
            checked
            @endif disabled>
            <label class="form-check-label" for="flexSwitchCheckChecked">{{__('active')}}</label>
        </div>
    </div>
    </form>
</div>
@endsection
