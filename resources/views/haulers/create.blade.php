@extends('layouts.app')
@section('title')
{{__('Create New Hauler')}}
@endsection
@section('page-title')
{{__('Create New Hauler')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="w-100 bg-dark">
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('haulers.index') }}">{{__('Back')}}</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col border-right">
        <form class="form-floating text-center col-md-8 m-auto" action="{{route('hauler.store')}}" method="POST">
            @csrf
            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control text-capitalize" id="floatingInput" placeholder="title Name"
                    name="name">
                <label for="floatingInput" class="text-capitalize">{{__('hauler name')}}</label>
            </div>
            <button class="btn btn-success text-capitalize">
                submit</button>
        </form>
    </div>
</div>

@endsection
