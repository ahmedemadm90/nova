@extends('layouts.app')
@section('title')
{{__('New Location')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
{{__('New Location')}}
@endsection
@section('page-title-desc')
{{__('Create New Plant Location')}}
<hr class="w-100 bg-dark">
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('locations.index') }}">{{__('Back')}}</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md border-right mb-2">
        @include('layouts.sessions')
        @include('layouts.errors')
        <form class="form-floating text-center col-md-8 m-auto" action="{{route('location.store')}}" method="POST">
            @csrf
            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control" id="floatingInput" placeholder="Vp Name" name="location_name">
                <label for="floatingInput">{{__('Location Name')}}</label>
            </div>
            <div class="form-floating m-3 w-auto">
                <select class="form-select text-capitalize" name="country_id">
                    <option class="text-capitalize" selected hidden>{{__('select Country')}}</option>
                    @foreach ($countries as $country)
                    <option class="text-capitalize" value="{{$country->id}}">{{$country->country_name}}</option>
                    @endforeach
                </select>
                <label for="floatingInput">{{__('Country')}}</label>
            </div>
            <button class="btn btn-success text-capitalize">{{__('Add')}}</button>
        </form>
    </div>
</div>

@endsection
