@extends('layouts.app')
@section('title')
{{__('Violation No.')}} || {{$vio->code}}
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
    <div class="row m-auto p-1">
        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input type="number" class="form-control" placeholder="violation code" value="{{$vio->code}}" disabled>
                <label for="floatingInputGrid">{{__('violation code')}}</label>
            </div>
        </div>
        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input class="form-control text-capitalize" id="code" placeholder="violation VP"
                    value="{{$vio->vp->vp_name}}" disabled>
                <label for="floatingInputGrid">{{__('violation VP')}}</label>
            </div>
        </div>
        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input class="form-control" placeholder="violation Area" value="{{$vio->area->area_name}}" disabled>
                <label for="floatingInputGrid">{{__('violation Area')}}</label>
            </div>
        </div>
        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGrid" name="location"
                    placeholder="violation location" style="font-family: sans-serif" value="{{$vio->location}}"
                    disabled>
                <label for="floatingInputGrid">{{__('violation Location')}}</label>
            </div>
        </div>
    </div>
    <div class="row m-auto p-1">
        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input class="form-control" id="floatingInputGrid" name="date" placeholder="violation Date"
                    value="{{$vio->date}}" disabled>
                <label for="floatingInputGrid">{{__('violation date')}}</label>
            </div>
        </div>
        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input type="time" class="form-control text-capitalize" name="time" placeholder="time"
                    value="{{$vio->time}}" disabled>
                <label for="floatingInputGrid">{{__('violation time')}}</label>
            </div>
        </div>
        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input class="form-control text-capitalize" name="time" placeholder="time" value="{{$vio->category}}"
                    disabled>
                <label for="floatingInputGrid">{{__('violation Category')}}</label>
            </div>
        </div>
        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input class="form-control text-capitalize" name="time" placeholder="time" value="{{$vio->type}}"
                    disabled>
                <label for="floatingInputGrid">{{__('violation Type')}}</label>
            </div>
        </div>
    </div>

    <div class="row m-auto p-1">
        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input class="form-control text-capitalize" name="inv_id" placeholder="Involvoed Person id"
                    value="{{$vio->inv_id}}" disabled>
                <label for="floatingInputGrid">{{__('invoved iD')}}</label>
            </div>
        </div>
        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input type="text" class="form-control text-capitalize" name="inv_name"
                    placeholder="involved person name" value="{{$vio->inv_name}}" disabled>
                <label for="floatingInputGrid">{{__('invoved name')}}</label>
            </div>
        </div>
        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input type="text" class="form-control text-capitalize" name="inv_pos"
                    placeholder="involved person position" value="{{$vio->inv_pos}}" disabled>
                <label for="floatingInputGrid">{{__('invoved position')}}</label>
            </div>
        </div>
        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input type="text" class="form-control text-capitalize" name="inv_company"
                    placeholder="involved person company" value="{{$vio->inv_company}}" disabled>
                <label for="floatingInputGrid">{{__('invoved company')}}</label>
            </div>
        </div>
    </div>

    <div class="row m-auto p-1">
        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input type="text" class="form-control text-capitalize" name="inv_company"
                    placeholder="involved person company" value="{{$vio->inv_type}}" disabled>
                <label for="floatingInputGrid">{{__('invoved type')}}</label>
            </div>
        </div>
        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input type="text" class="form-control text-capitalize" placeholder="area responsible"
                    value="{{$vio->area_res->name}}" disabled>
                <label for="floatingInputGrid">{{__('area responsible')}}</label>
            </div>
        </div>

        <div class="col-md-3 m-auto">
            <div class="form-floating">
                <input type="number" class="form-control text-capitalize" name="nearmiss" placeholder="near miss"
                    value="{{$vio->nearmiss}}" disabled>
                <label for="floatingInputGrid">{{__('near miss')}}</label>
            </div>
        </div>
    </div>
    <br>
    <hr class="dropdown-divider bg-dark p-1 w-100">
    <h3 class="text-center m-3 w-100">{{__('violation details')}}</h3>
    <div class="row">


        <div class="form-group col-md-6">
            <textarea class="form-control w-100 text-capitalize" rows="6" style="resize: none;"
                placeholder="description" disabled>{{$vio->description}}</textarea>
        </div>
        <div class="form-group col-md-6">
            <textarea class="form-control w-100 text-capitalize" rows="6" style="resize: none;" placeholder="actions"
                name="action" disabled>{{$vio->action}}</textarea>
        </div>
    </div>
    <hr class="dropdown-divider bg-dark p-1 w-100">
    <h3 class="text-center m-3 w-100">{{__('violation media')}}</h3>
    <div class="row">


        <div class="col-md-6">
            <label>{{__('image')}}</label>
            <br>
            <img src='{{asset("media/violations/imgs/$vio->img")}}' style="height: 240px">
        </div>
        <div class="col-md-6">
            <label>{{__('Video')}}</label><br>
            <video width="320" height="240" src='{{asset("media/violations/vids/$vio->vid")}}'" controls></video>
        </div>
    </div>
</div>
@endsection
