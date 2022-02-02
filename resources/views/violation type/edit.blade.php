@extends('layouts.app')
@section('title')
{{__('Edit Violation Type')}}
@endsection
@section('page-title')
{{__('Edit Violation Type')}} <span class="text-capitalize text-danger">{{$type->classification}}</span>
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="p-1">
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{!! Form::model($type, ['method' => 'PATCH','route' => ['classification.update', $type->id]]) !!}
<div class="row text-center">
    <div class="col-xs-6 col-sm-6 col-md-6 m-auto">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" placeholder="Classification"
                name="classification" value="{{$type->classification}}">
            <label for="floatingInput">{{__('Classification')}}</label>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center m-3">
            <button type="submit" class="btn btn-primary text-capitalize">{{__('update')}}</button>
        </div>
    </div>
    {!! Form::close() !!}

    @endsection
