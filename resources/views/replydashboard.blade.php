@extends('layouts.app')
@section('cards')
<hr>
@include('layouts.cards')
@endsection
@section('title')
{{__('Dashboard')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
<div class="row">
    <span class="col-md-6">{{__('Dashboard')}}</span>
</div>
@endsection
@section('content')
<a href="{{route('test.dashboard')}}" class="btn btn-success">Back</a>
<hr>
@if (!empty($egyDataset))
<div class="col-12 col-md-3 m-auto fs-1">
    <div class="card card-statistic">
        <div class="card-body p-0">
            <div class="d-flex flex-column">
                <div class='px-3 py-3 d-flex justify-content-between'>
                    <h3 class='card-title'>{{__('Egy Total Violations')}}</h3>
                    <div class="card-right d-flex align-items-center">
                        <p class="badge bg-danger">{{$egyTotal}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="row mb-2 text-center m-auto">
        @foreach ($egyDataset as $key=>$value)
        <div class="col-md-3 m-auto">
            <a type="button" class="btn btn-primary position-relative m-2">
                {{$key}}
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{$value}}
                </span>
            </a>
        </div>
        @endforeach
    </div>
    <div class="m-auto col-md-5">
        {!! $egyviolationsbyarea->render() !!}
    </div>
</div>
<hr>
@endif
@if (!empty($uaeDataset))
<div class="col-12 col-md-3 m-auto fs-1">
    <div class="card card-statistic">
        <div class="card-body p-0">
            <div class="d-flex flex-column">
                <div class='px-3 py-3 d-flex justify-content-between'>
                    <h3 class='card-title'>{{__('Uae Total Violations')}}</h3>
                    <div class="card-right d-flex align-items-center">
                        <p class="badge bg-danger">{{$uaeTotal}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="row mb-2 text-center m-auto">
        @foreach ($uaeDataset as $key=>$value)
        <div class="col-md-3 m-auto">
            <span type="button" class="btn btn-primary position-relative m-2">
                {{$key}}
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{$value}}
                </span>
            </span>
        </div>
        @endforeach
    </div>
    <div class="m-auto col-md-5">
        {!! $uaeviolationsbyarea->render() !!}
    </div>
</div>
@endif

@endsection
