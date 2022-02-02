@extends('layouts.app')
@section('title')
{{__('Show Switch Info')}} || {{$switch->name}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
{{__('Show Switch Info')}}
@endsection
@section('content')

<hr class="">
<div class="row">
    <div class="col-lg-12 m-2">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('switches.index') }}">{{__('Back')}}</a>
        </div>
    </div>
</div>
<div class="row text-capitalize mt-5">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">


        </div>
    </div>

</div>
@endsection
