@extends('layouts.master')
@section('title')
Show Role
@endsection
@section('cards')
@include('layouts.contentheader')
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('footer')
@include('layouts.footer')
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Title</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('titles.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $title->title_name }}
        </div>
    </div>
</div>
@endsection
