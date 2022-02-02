@extends('layouts.app')
@section('title')
{{__('Edit Vlan')}} || {{$vlan->name}}
@endsection
@section('page-title')
{{__('Edit Vlan')}} || <span class="text-capitalize text-danger">{{$vlan->name}}</span>
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
            <a class="btn btn-primary" href="{{ route('vlans.index') }}">{{__('Back')}}</a>
        </div>
    </div>
    @include('layouts.sessions')
    <div class="col border-right">
        <form class="form-floating text-center col-md-10 m-auto" action="{{route('vlan.update',$vlan->id)}}"
            method="POST">
            @csrf
            @include('layouts.errors')
            <div class="row m-2">
                <div class="col-md m-2">
                    <div class="form-floating m-auto">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Vp Name" name="name"
                            value="{{$vlan->name}}">
                        <label for="floatingInput">{{__('Vlan')}}</label>
                    </div>
                </div>
                <div class="col-md m-2">
                    <div class="form-floating m-auto">
                        <select class="form-select" name="switch_id">
                            <option selected hidden value="{{$vlan->switch_id}}">{{$vlan->switch->name}}</option>
                            @foreach ($switches as $switch)
                            <option value="{{$switch->id}}">{{$switch->name}}</option>
                            @endforeach
                        </select>
                        <label for="floatingInput">{{__('Vlan')}}</label>
                    </div>
                </div>
                <div class="col-md m-2">
                    <div class="form-floating m-auto">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Vp Name" name="gateway"
                            value="{{$vlan->gateway}}">
                        <label for="floatingInput">{{__('Gateway')}}</label>
                    </div>
                </div>
            </div>
            <div class="row m-2">
                <div class="col-md m-2">
                    <div class="form-floating m-auto">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Start IP"
                            name="start_ip" value="{{$vlan->start_ip}}">
                        <label for="floatingInput">{{__('Start IP')}}</label>
                    </div>
                </div>
                <div class="col-md m-2">
                    <div class="form-floating m-auto">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Vp Name" name="end_ip"
                            value="{{$vlan->end_ip}}">
                        <label for="floatingInput">{{__('End IP')}}</label>
                    </div>
                </div>
                <div class="col-md-2 form-check form-switch m-auto fs-3">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" value="1" name="active"
                        @if ($vlan->active==1)
                    checked
                    @endif>
                    <label class="form-check-label" for="flexSwitchCheckChecked">{{__('active')}}</label>
                </div>
            </div>
            <button class="btn btn-success">
                {{__('Update')}}</button>
        </form>
    </div>
</div>

@endsection
