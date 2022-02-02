@extends('layouts.app')
@section('title')
Show Area Info
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
Show Area Info
@endsection
@section('page-title-desc')
Shows How Many Employees In This Area
@endsection
@section('content')
<hr class="">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('areas.index') }}">Back</a>
        </div>
    </div>
</div>
<div class="row text-capitalize mt-5">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <h3>Name : {{ $area->area_name }}</h3>
            <h3>Employees : {{ $workers }}</h3>
        </div>
    </div>

</div>
@endsection
