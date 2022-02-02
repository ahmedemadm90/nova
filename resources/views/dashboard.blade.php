@extends('layouts.app')
@section('cards')
<hr>
@can('Cards')
@include('layouts.cards')
@endcan
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
    @can('Dashboard Date Statics')
    <div class="col-md-6">
        <form action="{{route('dashboardByDate')}}" class="row form form-inline" method="post" id="test">
            @csrf
            <div class="col-md-5 m-auto">
                <div class="form-floating">
                    <input type="date" class="form-control" id="floatingInputGrid" name="date_from"
                        placeholder="violation Date" id="date_from">
                    <label for="floatingInputGrid" class="fs-5">{{__('Date From')}}</label>
                </div>
            </div>
            <div class="col-md-5 m-auto">
                <div class="form-floating">
                    <input type="date" class="form-control" id="floatingInputGrid" name="date_to"
                        placeholder="Date From" id="date_to">
                    <label for="floatingInputGrid" class="fs-5">{{__('Date To')}}</label>
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success" id="dashboardjson">{{__('Submit')}}</button>
            </div>
        </form>
    </div>
    @endcan
</div>
@endsection
@section('content')
@can('Dashboard Egy Violations')
<div class="row text-center justify-content-center m-auto border">
    <div class="row">
        <h1 class="text-center text-decoration-underline mb-2">{{__('EGY Violations')}}</h1>
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
        <div class="col-md-2 m-2">
            <a type="button" class="btn btn-primary position-relative"
                href="{{route('violations.searchType',['type'=>$key])}}">
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
@endcan
@can('Dashboard Uae Violations')
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
            <a type="button" class="btn btn-primary position-relative m-2"
                href="{{route('uae.violations.searchType',['type'=>$key])}}">
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
@endcan
@can('Violations Contriputions')

@endcan
<h3 class="text-center">Hello <span class="text-danger text-decoration-underline">{{auth()->user()->name}}</span></h3>
<p class="text-center fs-5">All Your Contripution In Violations</p>
<div class="row">
    <div class="col-md mt-2 hover">
        <div class="col-md-6 m-auto">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3 d-flex justify-content-between'>
                            <h3 class='card-title'>EGY</h3>
                            <div class="card-right d-flex align-items-center">
                                <p>{{$egy}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md mt-2 hover">
        <div class="col-md-6 m-auto m-auto">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3 d-flex justify-content-between'>
                            <h3 class='card-title'>UAE</h3>
                            <div class="card-right d-flex align-items-center">
                                <p>{{$uae}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @if (!empty($egy))
    <div class="col-md-6 col-lg-6 col-sm-6 m-auto">
        <div class="m-auto w-75">
            {!!$user_egy_vios_chart->render()!!}
        </div>
    </div>
    @endif
    @if (!empty($egy))
    <div class="col-md-6 col-lg-6 col-sm-6 m-auto">
        <div class="m-auto w-75" id="test">
            {!!$user_uae_vios_chart->render()!!}
        </div>
    </div>
    @endif
</div>
@endsection
