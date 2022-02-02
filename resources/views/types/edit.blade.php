@extends('layouts.app')
@section('title')
Edit Worker Type
@endsection
@section('page-title')
Edit Worker Type || <span class="text-danger">{{$type->type_name}}</span>
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title-desc')
Edit Worker Type
@endsection
@section('content')
<hr class="">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('types.index') }}">Back</a>
        </div>
    </div>
</div>
<form class="form-floating text-center col-md-8 m-auto" action="{{route('type.update',$type->id)}}" method="POST">
    @csrf
    <div class="form-floating m-3 w-auto text-capitalize">
        <input type="text" class="form-control text-capitalize" id="floatingInput" placeholder="Type Name"
            name="type_name" value="{{$type->type_name}}">
        <label for="floatingInput">New Type Name</label>
    </div>
    <button class="btn btn-success text-capitalize" type="submit">
        Update
    </button>
</form>
@endsection
