@extends('layouts.app')
@section('title')
{{__('Add New VP')}}
@endsection
@section('page-title')
{{__('New VP')}}
@endsection
@section('page-title-desc')
{{__('Add New Plant VP')}}
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
            <a class="btn btn-primary" href="{{ route('vps.index') }}">{{__('Back')}}</a>
        </div>
    </div>
    @include('layouts.sessions')
    <div class="col border-right">
        <form class="form-floating text-center col-md-8 m-auto" action="{{route('vp.store')}}" method="POST">
            @csrf
            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control" id="floatingInput" placeholder="Vp Name" name="vp_name">
                <label for="floatingInput">{{__('VP Name')}}</label>
            </div>
            <div class="form-floating m-3 w-auto">
                <select class="form-select" name="region_id">
                    <option value="" disabled hidden selected>{{__('VP Region')}}</option>
                    @foreach ($regions as $region)
                    <option value=" {{$region->id}}">{{$region->country_name}}</option>
                    @endforeach
                </select>
                <label for="floatingInput">{{__('VP Region')}}</label>
            </div>
            <button class="btn btn-success">
                {{__('Add')}}</button>
        </form>
    </div>
</div>

@endsection
