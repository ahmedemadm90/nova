@extends('layouts.app')
@section('title')
{{__('New NVR/DVR')}}
@endsection
@section('page-title')
{{__('New NVR/DVR')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="w-100 bg-dark">
<div class="alert alert-danger text-center" id="errHdd" hidden>
    {{__('The Device Must Have At Least 1 HDD')}}
</div>
<div class="container text-capitalize text-center" style="font-family: sans-serif">
    @include('layouts.errors')
    <form class="row m-auto text-center" action="{{route('dvr.store')}}" method="POST" enctype="multipart/form-data"
        autocomplete="false">

        @csrf
        <div class="row m-2">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="name" class="form-control text-capitalize" placeholder="Device Name">
                    <label class="text-capitalize">{{__('Name')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select class="form-control text-capitalize form-select" name="type">
                        <option hidden selected>{{__('Choose Device Type')}}</option>
                        <option class="text-capitalize" value="NVR">{{__('NVR')}}</option>
                        <option class="text-capitalize" value="DVR">{{__('DVR')}}</option>
                    </select>
                    <label class="text-capitalize">{{__('Choose Device Type')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="install_location" class="form-control text-capitalize" placeholder="From">
                    <label class="text-capitalize">{{__('install Location')}}</label>
                </div>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="region" class="form-control text-capitalize" placeholder="Device Name">
                    <label class="text-capitalize">{{__('region')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <div class="form-floating">
                        <input type="text" name="location" class="form-control text-capitalize"
                            placeholder="Device Name">
                        <label class="text-capitalize">{{__('location')}}</label>
                    </div>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="area" class="form-control text-capitalize" placeholder="From">
                    <label class="text-capitalize">{{__('area')}}</label>
                </div>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="brand" class="form-control text-capitalize" placeholder="Device Name">
                    <label class="text-capitalize">{{__('brand')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="model" class="form-control text-capitalize" placeholder="Device Name">
                    <label class="text-capitalize">{{__('model')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="sw_ver" class="form-control text-capitalize" placeholder="Device Name">
                    <label class="text-capitalize">{{__('software version')}}</label>
                </div>
            </div>

        </div>
        <div class="row m-2">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="code" class="form-control text-capitalize" placeholder="code">
                    <label class="text-capitalize">{{__('code')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="number" name="total_chs" class="form-control text-capitalize"
                        placeholder="Total Channels">
                    <label class="text-capitalize">{{__('total channels')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="number" name="hdd_cap" class="form-control text-capitalize"
                        placeholder="How Many HDDs Fit Inside">
                    <label class="text-capitalize">{{__('HDDs Max Count')}}</label>
                </div>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="number" name="unit_cap" class="form-control text-capitalize" placeholder="HDDs Count"
                        id="unit_cap">
                    <label class="text-capitalize">{{__('Max Capacity Per HDD')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="number" name="total_storage" class="form-control text-capitalize"
                        placeholder="total storage">
                    <label class="text-capitalize">{{__('total storage')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="number" name="qty" class="form-control text-capitalize" placeholder="total storage">
                    <label class="text-capitalize">{{__('Quantity')}}</label>
                </div>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="ip" class="form-control text-capitalize" placeholder="HDDs Count"
                        id="unit_cap">
                    <label class="text-capitalize">{{__('device ip')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" name="username" class="form-control" placeholder="total storage"
                        autocomplete="false">
                    <label class="text-capitalize">{{__('username')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" placeholder="total storage">
                    <label class="text-capitalize">{{__('password')}}</label>
                </div>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md-2 form-check form-switch m-auto fs-3">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" value="1" name="active">
                <label class="form-check-label" for="flexSwitchCheckChecked">{{__('active')}}</label>
            </div>
        </div>
        <div class="row m-2">
            <button class="btn btn-success col-md-3 m-auto" type="submit">{{__('Submit')}}</button>
        </div>
    </form>
</div>
@endsection
