@extends('layouts.app')
@section('title')
Edit VP
@endsection

@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
Edit Area <span class="text-danger">{{$area->area_name}}</span>
@endsection
@section('content')
<hr class="w-100 bg-dark">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('areas.index') }}">Back</a>
        </div>
    </div>
</div>
<form class="form-floating text-center col-md-8 m-auto" action="{{route('area.update',$area->id)}}" method="POST">
    @csrf
    @include('layouts.errors')
    <div class="form-floating m-3 w-auto text-capitalize">
        <input type="text" class="form-control text-capitalize" id="floatingInput" placeholder="Vp Name"
            name="area_name" value="{{$area->area_name}}">
        <label for="floatingInput">New Area Name</label>
    </div>
    <div class="form-floating m-3 w-auto text-capitalize">
        <select class="form-select text-capitalize" name="vp_id">
            @foreach ($vps as $vp)
            <option value="{{$vp->id}}" @if ($area->vp_id == $vp->id) selected
                @endif>
                {{$vp->vp_name}}</option>
            @endforeach
        </select>
        {{-- <input type="text" class="form-control text-capitalize" id="floatingInput" placeholder="Vp Name" name="vp_name"
            value="{{$vp->vp_name}}"> --}}
        <label for="floatingInput">VP Name</label>
    </div>
    <button class="btn btn-success text-capitalize" type="submit">
        Update
    </button>
</form>
@endsection
