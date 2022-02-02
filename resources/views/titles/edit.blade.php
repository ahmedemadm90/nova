@extends('layouts.app')
@section('title')
Edit title
@endsection
@section('page-title')
Edit title <span class="text-capitalize text-danger">{{$title->title_name}}</span>
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title-desc')
Change Worker's Title
@endsection
@section('content')
<hr class="p-1">
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{!! Form::model($title, ['method' => 'PATCH','route' => ['title.update', $title->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-floating">
            <input type="name" class="form-control" id="floatingInput" placeholder="title name" name="title_name"
                value="{{$title->title_name}}">
            <label for="floatingInput">{{__('Name')}}</label>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center m-3">
            <button type="submit" class="btn btn-primary text-capitalize">update</button>
        </div>
    </div>
    {!! Form::close() !!}

    @endsection
