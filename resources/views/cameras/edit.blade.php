@extends('layouts.app')
@section('title')
{{__('New Camera')}}
@endsection
@section('page-title')
{{__('New Camera')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<button class="btn btn-info">Upload</button>
<hr class="w-100 bg-dark">
<div class="container text-capitalize text-center" style="font-family: sans-serif">
    @include('layouts.errors')
    <form class="row m-2 text-center" action="{{route('camera.update',$cam->id)}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" name="code" placeholder="Region" value="{{$cam->code}}">
                    <label for="floatingInputGrid">{{__('Code')}}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" name="region" placeholder="Region" value="{{$cam->region}}">
                    <label for="floatingInputGrid">{{__('Region')}}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" name="segment" placeholder="Region"
                        value="{{$cam->segment}}">
                    <label for="floatingInputGrid">{{__('segment')}}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" name="location" placeholder="Region"
                        value="{{$cam->location}}">
                    <label for="floatingInputGrid">{{__('location')}}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" name="area" placeholder="area" value="{{$cam->area}}">
                    <label for="floatingInputGrid">{{__('area')}}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" name="en_name" placeholder="Camer Name"
                        value="{{$cam->en_name}}">
                    <label for="floatingInputGrid">{{__('Camera Name')}}</label>
                </div>
            </div>

        </div>
        <div class="row mt-1">
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" name="ar_name" placeholder="Region"
                        value="{{$cam->ar_name}}">
                    <label for="floatingInputGrid">{{__('Arabic Name')}}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <select name="is_operation" class="form-select text-capitalize">
                        <option value="{{$cam->is_operation}}" selected hidden>{{$cam->is_operation}}</option>
                        <option value="operation" class="text-capitalize">{{__('operation')}}</option>
                        <option value="non operation" class="text-capitalize">{{__('non-operation')}}
                        </option>
                    </select>
                    <label for="floatingInputGrid">{{__('Operational')}}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <select name="switch_id" class="form-select text-capitalize">
                        <option value="" selected disabled hidden>{{__('Switch')}}</option>
                        @foreach ($switches as $switch)
                        <option value="{{$switch->id}}" class="text-capitalize" @if ($cam->switch_id == $switch->id)
                            selected
                            @endif>{{$switch->name}}</option>
                        @endforeach
                        </option>
                    </select>
                    <label for="floatingInputGrid">{{__('Switch')}}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <select name="vlan_id" class="form-select text-capitalize">
                        <option value="" selected disabled hidden>{{__('V Lan')}}</option>
                        @foreach ($vlans as $vlan)
                        <option value="{{$vlan->id}}" class="text-capitalize" @if ($cam->vlan_id == $vlan->id)
                            selected
                            @endif>{{$vlan->name}}</option>
                        @endforeach
                        </option>
                    </select>
                    <label for="floatingInputGrid">{{__('Vlan')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="dvr_id" class="form-select text-capitalize">
                        <option value="" selected hidden>{{__('Choose DVR')}}</option>
                        @foreach ($dvrs as $dvr)
                        <option value="{{$dvr->id}}" @if ($cam->dvr_id == $dvr->id)
                            selected
                            @endif>{{$dvr->name}}</option>
                        @endforeach
                    </select>
                    <label for="floatingInputGrid">{{__('DVR')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="type" class="form-select text-capitalize">
                        <option value="{{$cam->type}}" selected hidden>{{$cam->type}}</option>
                        <option value="analog" class="text-capitalize">{{__('analog')}}</option>
                        <option value="ip fixed" class="text-capitalize">{{__('ip fixed')}}</option>
                        <option value="ip ptz" class="text-capitalize">{{__('ip ptz')}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('Camera Type')}}</label>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" name="brand" placeholder="brand" value="{{$cam->brand}}">
                    <label for="floatingInputGrid">{{__('brand')}}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input class="form-control" placeholder="Camera Model" name="model" type="text"
                        value="{{$cam->model}}">
                    <label for="floatingInputGrid">{{__('Camera Model')}}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input class="form-control" placeholder="Camera SN." name="serial" type="text"
                        value="{{$cam->serial}}">
                    <label for="floatingInputGrid">{{__('Camera SN.')}}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input class="form-control" placeholder="Camera IP" name="ip" type="text" value="{{$cam->ip}}">
                    <label for="floatingInputGrid">{{__('Camera IP')}}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input class="form-control" placeholder="Camera Username" name="username" type="text"
                        value="{{$cam->username}}">
                    <label for="floatingInputGrid">{{__('Camera Username')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input class="form-control" placeholder="Camera Password" name="password" type="text"
                        value="{{$cam->password}}">
                    <label for="floatingInputGrid">{{__('Camera Password')}}</label>
                </div>
            </div>

        </div>
        <div class="row mt-1">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input class="form-control" placeholder="Camera Password" name="resolution" type="number"
                        value="{{$cam->resolution}}">
                    <label for="floatingInputGrid">{{__('Camera resolution')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="maintenance" class="form-select text-capitalize">
                        <option value="{{$cam->maintenance}}" selected hidden>{{$cam->maintenance}}</option>
                        <option value="no need" class="text-capitalize">{{__('no need')}}</option>
                        <option value="building Stairs" class="text-capitalize">{{__('building Stairs')}}</option>
                        <option value="crane 65" class="text-capitalize">{{__('crane 65')}}</option>
                        <option value="factory crane" class="text-capitalize">{{__('factory crane')}}</option>
                        <option value="ladder" class="text-capitalize">{{__('ladder')}}</option>
                        <option value="ladder indoor" class="text-capitalize">{{__('ladder indoor')}}</option>
                        <option value="ladder outdoor" class="text-capitalize">{{__('ladder outdoor')}}</option>
                        <option value="manleft" class="text-capitalize">{{__('manleft')}}</option>
                        <option value="on ground" class="text-capitalize">{{__('on ground')}}</option>
                        <option value="over belt" class="text-capitalize">{{__('over belt')}}</option>
                        <option value="scissor lift" class="text-capitalize">{{__('scissor lift')}}</option>
                        <option value="tower ladder" class="text-capitalize">{{__('tower ladder')}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('Maintenance Method')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="clean" class="form-select text-capitalize">
                        <option value="{{$cam->clean}}" selected hidden>{{$cam->clean}}</option>
                        <option value="no need" class="text-capitalize">{{__('no need')}}</option>
                        <option value="building Stairs" class="text-capitalize">{{__('building Stairs')}}</option>
                        <option value="crane 65" class="text-capitalize">{{__('crane 65')}}</option>
                        <option value="factory crane" class="text-capitalize">{{__('factory crane')}}</option>
                        <option value="ladder" class="text-capitalize">{{__('ladder')}}</option>
                        <option value="ladder indoor" class="text-capitalize">{{__('ladder indoor')}}</option>
                        <option value="ladder outdoor" class="text-capitalize">{{__('ladder outdoor')}}</option>
                        <option value="manleft" class="text-capitalize">{{__('manleft')}}</option>
                        <option value="on ground" class="text-capitalize">{{__('on ground')}}</option>
                        <option value="over belt" class="text-capitalize">{{__('over belt')}}</option>
                        <option value="scissor lift" class="text-capitalize">{{__('scissor lift')}}</option>
                        <option value="tower ladder" class="text-capitalize">{{__('tower ladder')}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('Clean Method')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="connection" class="form-select text-capitalize">
                        <option value="{{$cam->connection}}" selected hidden>{{$cam->connection}}</option>
                        <option value="direct connect" class="text-capitalize">{{__('direct connect')}}</option>
                        <option value="fiber to nvr" class="text-capitalize">{{__('fiber to NVR')}}</option>
                        <option value="local" class="text-capitalize">{{__('local')}}</option>
                        <option value="remote" class="text-capitalize">{{__('Remote')}}</option>
                        <option value="UTP" class="text-capitalize">{{__('UTP')}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('Connection Type')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="power" class="form-select text-capitalize">
                        <option value="{{$cam->power}}" selected hidden>{{$cam->power}}</option>
                        <option value="12 v" class="text-capitalize">{{__('12 v')}}</option>
                        <option value="24 v" class="text-capitalize">{{__('24 v')}}</option>
                        <option value="adapter" class="text-capitalize">{{__('adapter')}}</option>
                        <option value="POE" class="text-capitalize">{{__('POE')}}</option>
                        <option value="power supply" class="text-capitalize">{{__('power supply')}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('Power Adapter')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input class="form-control" placeholder="Company" name="company" type="company"
                        value="{{$cam->company}}">
                    <label for="floatingInputGrid">{{__('Company')}}</label>
                </div>
            </div>

        </div>
        <div class="row mt-1">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input class="form-control" placeholder="year" name="year" type="number" value="{{$cam->year}}">
                    <label for="floatingInputGrid">{{__('year')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="install_state" class="form-select text-capitalize">
                        <option value="{{$cam->install_state}}" selected hidden class="text-capitalize">
                            {{$cam->install_state}}</option>
                        <option value="installed" class="text-capitalize">{{__('installed')}}</option>
                        <option value="in progress" class="text-capitalize">{{__('in progress')}}</option>
                    </select>
                    <label for="floatingInputGrid" class="text-capitalize">{{__('install state')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="state" class="form-select text-capitalize">
                        <option value="{{$cam->state}}" selected hidden class="text-capitalize">{{$cam->state}}</option>
                        <option value="online" class="text-capitalize">{{__('online')}}</option>
                        <option value="offline" class="text-capitalize">{{__('offline')}}</option>
                    </select>
                    <label for="floatingInputGrid" class="text-capitalize">{{__('camera state')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="alarm" class="form-select text-capitalize">
                        <option value="{{$cam->alarm}}" selected hidden class="text-capitalize">{{$cam->alarm}}
                        </option>
                        <option value="enabled" class="text-capitalize">{{__('enabled')}}</option>
                        <option value="disabled" class="text-capitalize">{{__('disabled')}}</option>
                    </select>
                    <label for="floatingInputGrid" class="text-capitalize">{{__('camera state')}}</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-2 w-25 m-auto">{{__('Submit')}}</button>
    </form>
</div>
@endsection
