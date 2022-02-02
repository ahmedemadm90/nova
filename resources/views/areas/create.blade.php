@extends('layouts.app')
@section('title')
New Area
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
New Area
@endsection
@section('page-title-desc')
Create New Plant Area
<hr class="w-100 bg-dark">
@endsection
@section('content')
@include('layouts.sessions')
@include('layouts.errors')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('areas.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md border-right mb-2">

        <form class="form-floating text-center col-md-8 m-auto" action="{{route('area.store')}}" method="POST">
            @csrf
            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control" id="floatingInput" placeholder="Vp Name" name="area_name">
                <label for="floatingInput">Area Name</label>
            </div>
            <div class="form-floating m-3 w-auto">
                <select class="form-select text-capitalize" name="vp_id">
                    <option class="text-capitalize" selected hidden>select vP</option>
                    @foreach ($vps as $vp)
                    <option class="text-capitalize" value="{{$vp->id}}">{{$vp->vp_name}}</option>
                    @endforeach
                </select>
                <label for="floatingInput">Area Name</label>
            </div>
            <button class="btn btn-success text-capitalize">Add</button>
        </form>
    </div>
</div>

@endsection
