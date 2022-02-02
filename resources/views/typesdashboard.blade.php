@extends('layouts.app')
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
    <span class="col-md-6">{{__('Statics About a Classification Over VPs')}}</span>
</div>
@endsection
@section('content')
<div class="row text-center justify-content-center m-auto border">
    <div class="row mt-2 hover">
        @foreach ($vpsdataSet as $key=>$value)
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
        @foreach ($OneType as $key=>$value)
        <div class="col-md m-auto">
            <a type="button" class="btn btn-primary position-relative m-2"
                href="{{route('uae.violations.searchType',['type'=>$key,'date_from'=>$date_from,'date_to'=>$date_to])}}">
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
                {!! $OneType->render() !!}
            </div>
        </div>

    </div>
</div>
@endsection
