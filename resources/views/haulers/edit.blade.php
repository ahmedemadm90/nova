@extends('layouts.app')
@section('title')
{{__('Edit Hauler')}} || {{$hauler->name}}
@endsection
@section('page-title')
{{__('Edit title')}} <span class="text-capitalize text-danger">{{$hauler->name}}</span>
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
@include('layouts.sessions')
<hr>
{!! Form::model($hauler, ['method' => 'POST','route' => ['hauler.update', $hauler->id]]) !!}
<div class="row w-50 m-auto">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-floating">
            <input type="name" class="form-control" id="floatingInput" placeholder="hauler name" name="name"
                value="{{$hauler->name}}">
            <label for="floatingInput" class="text-capitalize">{{__('hauler name')}}</label>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center m-3">
            <button type="submit" class="btn btn-primary text-capitalize">update</button>
        </div>
    </div>
    {!! Form::close() !!}
    @endsection
