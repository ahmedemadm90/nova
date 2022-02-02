@extends('layouts.app')
@section('title')
Show User
@endsection
@section('page-title')
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title-desc')

@endsection
@section('content')
<hr class="p-1 m-2 w-100">

<div class="row text-capitalize">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <h1>Name : {{ $user->name }}</h1>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <h3>Email :{{ $user->email }}</h3>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <h3>{{ $user->state }}</h3>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Roles:</strong>
            @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
            <label class="badge badge-success">{{ $v }}</label>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
