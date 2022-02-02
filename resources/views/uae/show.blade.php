@extends('layouts.app')
@section('title')
{{__('Edit UAE Violation')}} || {{$vio->id}}
@endsection
@section('page-title')
{{__('Edit UAE Violation')}} || {{$vio->id}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')
<hr class="w-100 bg-dark">

<div class="container text-capitalize text-center" style="font-family: sans-serif">
    <div class="row">
        <h3 class="text-center ">{{__('violation information')}}</h3>
        <div class="row m-auto p-1">
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select name="vp_id" id="vp" class="form-select text-capitalize" disabled>
                        <option selected hidden>{{$vio->vp->vp_name}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('Choose violation VP')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select name="area_id" id="area" class="form-select text-capitalize" disabled>
                        <option selected hidden class="text-capitalize">
                            {{$vio->area->area_name}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('Choose violation Area')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="date" class="form-control" id="floatingInputGrid" name="date"
                        placeholder="violation Date" value="{{$vio->date}}" disabled>
                    <label for="floatingInputGrid">{{__('violation date')}}</label>
                </div>
            </div>
        </div>

        <div class="row m-auto p-1">
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="time" class="form-control text-capitalize" name="time" placeholder="time"
                        value="{{$vio->time}}" disabled>
                    <label for="floatingInputGrid">{{__('violation time')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select class="form-select text-capitalize" name="type" id="type" disabled>
                        <option class='text-capitalize' hidden selected>{{$vio->type}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('violation category')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select class="form-select text-capitalize" name="classification"
                        placeholder="violation classification" disabled>
                        <option selected hidden>{{$vio->vioType->classification}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('violation classification')}}</label>
                </div>
            </div>
        </div>
        <div id="involvedWorkers">
            @foreach ($insource as $key=>$value)
            <div class="row" id="involved">
                <div class="col-md" id="selectWorker">
                    <div class="form-floating">
                        <div class="form-floating m-3 w-auto">
                            <select class="form-select text-capitalize" disabled>
                                <option class="text-capitalize" selected hidden disabled>{{__('Involved Data')}}
                                </option>
                                @foreach ($workers as $worker)
                                <option class="text-capitalize" value="{{$worker->id}}" @if ($worker->id === $key)
                                    selected
                                    @endif>{{$worker->id}} ||
                                    {{$worker->name}} || {{$worker->company->company_name}}
                                </option>
                                @endforeach
                            </select>
                            <label for="floatingInput">{{__('Involved')}}</label>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @foreach ($outsource as $key=>$value)
        <div id="outsourceInfo">
            <div class="row m-2" id="outsource">
                <div class="col-md m-auto">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize" placeholder="outsource ids"
                            value="{{$key}}" disabled>
                        <label class="text-capitalize">{{__('outsource id')}}</label>
                    </div>
                </div>
                <div class="col-md m-auto">
                    <div class="form-floating">
                        <input type="text" name="outsource_names[]" class="form-control text-capitalize"
                            placeholder="outsource_names" value="{{$value}}" disabled>
                        <label class="text-capitalize">{{__('outsource name')}}</label>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <hr class="dropdown-divider bg-dark p-1 w-100">
        <h3 class="text-center m-3 w-100">{{__('violation details')}}</h3>
        <!--  -->
        <div class="form-group col-md-5 m-auto">
            <textarea class="form-control w-100 text-capitalize" rows="6" style="resize: none;"
                placeholder="description" name="description" disabled>{{$vio->description}}</textarea>
        </div>
        <div class="form-group col-md-5 m-auto">
            <textarea class="form-control w-100 text-capitalize" rows="6" style="resize: none;"
                placeholder="action taken" name="action" disabled>{{$vio->action}}</textarea>
        </div>
        <hr class="dropdown-divider bg-dark p-1 w-100">
        <h3 class="text-center m-3 w-100">{{ __('violation media') }}</h3>
        <div class="row">
            <div id="carouselExampleControlsNoTouching" class="carousel slide col-md-6" data-bs-touch="false"
                data-bs-interval="false">
                <div class="carousel-inner shadow-none mt-4">
                    <div class="row">
                        @foreach ($vio->gallery as $img)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src='{{ asset("public/media/violations/uae/images/$img") }}' style="height: 240px"
                                class="w-75">
                        </div>
                        @endforeach
                    </div>
                    <button class="btn btn-secondary m-3" type="button"
                        data-bs-target="#carouselExampleControlsNoTouching"
                        data-bs-slide="prev">{{ __('Previous') }}</button>
                    <button class="btn btn-primary m-3" type="button"
                        data-bs-target="#carouselExampleControlsNoTouching"
                        data-bs-slide="next">{{ __('Next') }}</button>
                </div>
            </div>
            <div class="col-md-6">
                <label>{{ __('Video') }}</label><br>
                <video class="w-100" src='{{ asset("public/media/violations/uae/video/$vio->video") }}'" controls
                            style=" height: 250px"></video>
            </div>
        </div>
        <hr class="dropdown-divider bg-dark p-1 w-100">
    </div>
</div>
@endsection
