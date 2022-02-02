@extends('layouts.app')
@section('title')
Add Worker Type
@endsection
@section('page-title')
New Worker Type
@endsection
@section('page-title-desc')
Add New Worker Type
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="w-100 bg-dark">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('types.index') }}">Back</a>
        </div>
    </div>
    <div class="col border-right">
        <form class="form-floating text-center col-md-8 m-auto" action="{{route('type.store')}}" method="POST">
            @csrf
            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control" id="floatingInput" placeholder="Type Name" name="type_name">
                <label for="floatingInput">Type Name</label>
            </div>
            <button class="btn btn-success">
                Add</button>
        </form>
    </div>
</div>

@endsection
