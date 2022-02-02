@extends('layouts.app')
@section('cards')
<hr>
@include('layouts.cards')
@endsection
@section('title')
{{__('Dashboard')}} of {{$date_from}} To {{$date_to}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
<div class="row">
    <span class="col-md-6">{{__('Dashboard')}} of {{$date_from}} To {{$date_to}}</span>
</div>
@endsection
@section('content')
<div class="row text-center justify-content-center m-auto border">
    <div class="row">
        <h1 class="text-center text-decoration-underline mb-2">{{__('Egy Violations')}}</h1>
    </div>
    <div class="row mt-2 hover">
        @foreach ($egydataSet as $key=>$value)
        <div class="col-12 col-md-3 m-auto">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3 d-flex justify-content-between'>
                            <h3 class='card-title'>{{$key}}</h3>
                            <div class="card-right d-flex align-items-center">
                                <p>{{$value}} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row mb-2 text-center m-auto">
        @foreach ($egytypesdataSet as $key=>$value)
        <div class="col-md m-auto">
            <a type="button" class="btn btn-primary position-relative"
                href="{{route('violations.searchDateType',['type'=>$key,'date_from'=>$date_from,'date_to'=>$date_to])}}">
                {{$key}}
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{$value}}
                </span>
            </a>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6 m-auto">
            <div class="m-auto w-75">
                {!! $egyviolationsbyclassification->render() !!}
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 m-auto">
            <div class="m-auto w-75" id="test">
                {!! $egyviolationsbyarea->render() !!}
            </div>
        </div>
    </div>
</div>
<div class="row text-center justify-content-center m-auto border">
    <div class="row">
        <h1 class="text-center text-decoration-underline mb-2">{{__('UAE Violations')}}</h1>
    </div>
    <div class="row mt-2 hover">
        @foreach ($dataSet as $key=>$value)
        <div class="col-12 col-md-3 m-auto">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3 d-flex justify-content-between'>
                            <h3 class='card-title'>{{$key}}</h3>
                            <div class="card-right d-flex align-items-center">
                                <p>{{$value}} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row mb-2 text-center m-auto">
        @foreach ($typesdataSet as $key=>$value)
        <div class="col-md m-auto">
            <a type="button" class="btn btn-primary position-relative"
                href="{{route('uae.violations.searchDateType',['type'=>$key,'date_from'=>$date_from,'date_to'=>$date_to])}}">
                {{$key}}
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{$value}}
                </span>
            </a>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6 m-auto">
            <div class="m-auto w-75">
                {!! $uaeviolationsbyclassification->render() !!}
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 m-auto">
            <div class="m-auto w-75" id="test">
                {!! $uaeviolationsbyarea->render() !!}
            </div>
        </div>
    </div>
</div>

@endsection
