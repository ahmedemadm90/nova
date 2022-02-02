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
@include('layouts.sessions')
<hr>
<div class="row">
    <form action="{{route('reply.dashboard')}}" class="row form form-inline" method="post" id="test">
        @csrf
        <div class="row m-auto mb-2 text-center">
            <div class="row hover hovering-zoom">
                <h2 class="m-2 text-decoration-underline">EGYPT VPs</h2>
                <div class="form-check form-switch col-md-4 fs-5">
                    <input class="form-check-input" type="checkbox" id="allEgyVps" value="">
                    <label class="form-check-label" for="allEgyVps">{{__('All')}}</label>
                </div>
                @foreach ($egyvps as $vp)
                <div class="form-check form-switch col-md-4 fs-5">
                    <input class="form-check-input egyVp" type="checkbox" id="{{$vp->vp_name}}" value="{{$vp->id}}"
                        name="egyvps[]">
                    <label class="form-check-label" for="{{$vp->vp_name}}">{{$vp->vp_name}}</label>
                </div>
                @endforeach
            </div>
            <div class="row">
                <h2 class="m-2 text-decoration-underline">UAE VPs</h2>
                <div class="form-check form-switch col-md-4 fs-5">
                    <input class="form-check-input" type="checkbox" id="allUaeVps" value="">
                    <label class="form-check-label" for="allEgyVps">{{__('All')}}</label>
                </div>
                @foreach ($uaevps as $vp)
                <div class="form-check form-switch col-md-4 fs-5">
                    <input class="form-check-input uaeVp" type="checkbox" id="{{$vp->vp_name}}" value="{{$vp->id}}"
                        name="uaevps[]">
                    <label class="form-check-label" for="{{$vp->vp_name}}">{{$vp->vp_name}}</label>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row w-75 m-auto">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="date" class="form-control" id="floatingInputGrid" name="date_from"
                        placeholder="violation Date" id="date_from">
                    <label for="floatingInputGrid" class="fs-5">{{__('Date From')}}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="date" class="form-control" id="floatingInputGrid" name="date_to"
                        placeholder="Date From" id="date_to">
                    <label for="floatingInputGrid" class="fs-5">{{__('Date To')}}</label>
                </div>
            </div>

        </div>
        <div class="">
            <div class="m-auto mt-2 text-center">
                <button class="btn btn-success" id="dashboardjson">{{__('Submit')}}</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script>
    $('#allEgyVps').change(function() {
    if ($(this).is(":checked")) {
    $('.egyVp').prop("checked", true);
    } else {
    $('.egyVp').prop("checked", false);
    }
    });
    $('#allUaeVps').change(function() {
    if ($(this).is(":checked")) {
    $('.uaeVp').prop("checked", true);
    } else {
    $('.uaeVp').prop("checked", false);
    }
    });
</script>
@endsection
