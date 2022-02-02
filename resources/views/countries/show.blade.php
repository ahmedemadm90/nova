@extends('layouts.app')
@section('title')
Show VP Info
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
Show VP Info
@endsection
@section('page-title-desc')
Shows How Many Employees In This VP
@endsection
@section('content')

<hr class="">
<div class="row">
    <div class="col-lg-12 m-2">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('vps.index') }}">Back</a>
        </div>
    </div>
</div>
<div class="row text-capitalize mt-5">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <h3>Name : {{ $vp->vp_name }}</h3>
            <h3>Employees : {{ $workers }}</h3>
        </div>
    </div>

</div>
@endsection
