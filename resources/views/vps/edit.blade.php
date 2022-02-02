@extends('layouts.app')
@section('title')
Edit VP
@endsection
@section('page-title')
Edit VP || <span class="text-danger">{{$vp->vp_name}}</span>
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title-desc')
Change VP Name
@endsection
@section('content')
<hr class="">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('vps.index') }}">Back</a>
        </div>
    </div>
</div>
<form class="form-floating text-center col-md-8 m-auto" action="{{route('vp.update',$vp->id)}}" method="POST">
    @csrf
    <div class="form-floating m-3 w-auto text-capitalize">
        <input type="text" class="form-control text-capitalize" id="floatingInput" placeholder="Vp Name" name="vp_name"
            value="{{$vp->vp_name}}">
        <label for="floatingInput">New VP Name</label>
    </div>
    <div class="form-floating m-3 w-auto">
        <select class="form-select" name="region_id">
            <option value="" disabled hidden selected>{{__('VP Region')}}</option>
            @foreach ($regions as $region)
            <option value=" {{$region->id}}" @if ($region->id == $vp->region_id)
                selected
                @endif>{{$region->country_name}}</option>
            @endforeach
        </select>
        <label for="floatingInput">{{__('VP Region')}}</label>
    </div>
    <button class="btn btn-success text-capitalize" type="submit">
        Update
    </button>
</form>
@endsection
