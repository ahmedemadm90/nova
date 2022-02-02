@extends('layouts.app')
@section('title')
{{__('New Country')}}
@endsection
@section('page-title')
{{__('New Country')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="w-100 bg-dark">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('countries.index') }}">{{__('Back')}}</a>
        </div>
    </div>
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="col border-right">
        <form class="form-floating text-center col-md-8 m-auto" action="{{route('country.store')}}" method="POST">
            @csrf
            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control" id="floatingInput" placeholder="Country Name"
                    name="country_name">
                <label for="floatingInput">{{__('Country Name')}}</label>
            </div>
            <button class="btn btn-success">
                {{__('Add')}}</button>
        </form>
    </div>
</div>

@endsection
