@extends('layouts.app')
@section('title')
{{__('Edit Truck')}} || {{$truck->truck_no}}
@endsection
@section('page-title')
{{__('Edit title')}} <span class="text-capitalize text-danger">{{$truck->truck_no}}</span>
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="w-100 bg-dark">
@include('layouts.sessions')
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('trucks.index') }}">{{__('Back')}}</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col border-right">
        <form class="form-floating text-center col-md-8 m-auto" action="{{route('truck.store')}}" method="POST">
            @csrf
            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control text-capitalize" id="floatingInput" placeholder="title Name"
                    name="truck_no" value="{{$truck->truck_no}}">
                <label for="floatingInput" class="text-capitalize">{{__('Full Truck No')}}</label>
            </div>
            <div class="form-floating m-3">
                <select class="form-select" name="hauler_id" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option class="text-caoitalize" disabled hidden selected>{{__('Select Hauler')}}</option>
                    @foreach ($haulers as $hauler)
                    <option value="{{$hauler->id}}" @if ($truck->hauler_id == $hauler->id)
                        selected
                        @endif>{{$hauler->name}}</option>
                    @endforeach
                </select>
                <label for="floatingSelect">{{__('Hauler')}}</label>
            </div>
            <button class="btn btn-success text-capitalize">
                Update</button>
        </form>
    </div>
</div>

@endsection
