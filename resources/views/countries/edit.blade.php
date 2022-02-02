@extends('layouts.app')
@section('title')
{{__('Edit Country')}}
@endsection
@section('page-title')
{{__('Edit Country')}} || <span class="text-danger">{{$country->country_name}}</span>
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title-desc')
{{__('Change Country Name')}}
@endsection
@section('content')
<hr class="">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('countries.index') }}">{{__('Back')}}</a>
        </div>
    </div>
</div>
<form class="form-floating text-center col-md-8 m-auto" action="{{route('country.update',$country->id)}}" method="POST">
    @csrf
    <div class="form-floating m-3 w-auto text-capitalize">
        <input type="text" class="form-control text-capitalize" id="floatingInput" placeholder="Vp Name"
            name="country_name" value="{{$country->country_name}}">
        <label for="floatingInput">{{__('New Country Name')}}</label>
    </div>
    <button class="btn btn-success text-capitalize" type="submit">
        {{__('Update')}}
    </button>
</form>
@endsection
