@extends('layouts.app')
@section('title')
Create Title
@endsection
@section('page-title')
New Worker Title
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title-desc')
All Workers Titles
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
            <a class="btn btn-primary" href="{{ route('titles.index') }}">Back</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col border-right">
        <form class="form-floating text-center col-md-8 m-auto" action="{{route('title.store')}}" method="POST">
            @csrf
            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control text-capitalize" id="floatingInput" placeholder="title Name"
                    name="title_name">
                <label for="floatingInput" class="text-capitalize">title</label>
            </div>
            <button class="btn btn-success text-capitalize">
                <i class="fas fa-plus-square m-2"></i> Add</button>
        </form>
    </div>
</div>

@endsection
