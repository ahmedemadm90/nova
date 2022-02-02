@extends('layouts.app')
@section('title')
{{ __('View Violation') }} || {{ $violation->id }}
@endsection
@section('page-title')
{{ __('View Violation') }} || {{ $violation->id }}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="w-100 bg-dark">

@include('layouts.sessions')
<div class="container text-capitalize text-center" style="font-family: sans-serif">
    <h3 class="text-center ">{{ __('violation information') }}</h3>
    @include('layouts.errors')
    <div class="row m-auto text-center">
        <div class="row mb-1 m-auto">
            <div class="col-md">
                <div class="form-floating">
                    <select name="vp_id" id="vp" class="form-select text-capitalize" disabled>
                        <option value="{{ $violation->vp->id }}">{{ $violation->vp->vp_name }}</option>
                    </select>
                    <label for="floatingInputGrid">{{ __('Choose violation VP') }}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="area_id" id="area" class="form-select text-capitalize" disabled>
                        <option value="{{ $violation->area->id }}">{{ $violation->area->area_name }}</option>
                    </select>
                    <label for="floatingInputGrid">{{ __('Choose violation Area') }}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInputGrid" name="location"
                        placeholder="violation location" style="font-family: sans-serif"
                        value="{{ $violation->location }}" disabled>
                    <label for="floatingInputGrid">{{ __('violation Location') }}</label>
                </div>
            </div>
        </div>
        <div class="row mb-1 m-auto">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="date" class="form-control" id="floatingInputGrid" name="date"
                        placeholder="violation Date" value="{{ $violation->date }}" disabled>
                    <label for="floatingInputGrid">{{ __('violation date') }}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="time" class="form-control text-capitalize" name="time" placeholder="time"
                        value="{{ $violation->time }}" disabled>
                    <label for="floatingInputGrid">{{ __('violation time') }}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select class="form-select" name="category" disabled>
                        <option class='text-capitalize' hidden selected value="{{ $violation->category }}">
                            {{ $violation->category }}</option>
                        <option class='text-capitalize' value="unsafe act">{{ __('unsafe act') }}</option>
                        <option class='text-capitalize' value="unsafe condition">{{ __('unsafe condition') }}</option>
                        <option class='text-capitalize' value="unsecure act">{{ __('unsecure act') }}</option>
                        <option class='text-capitalize' value="unsecure condition">{{ __('unsecure condition') }}
                        </option>
                    </select>
                    <label for="floatingInputGrid">{{ __('violation category') }}</label>
                </div>
            </div>
        </div>
        <div class="row mb-1 m-auto">
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="classification" class="form-select text-capitalize" disabled>
                        <option value="{{ $violation->vioType->id }}">
                            {{ $violation->vioType->classification }}</option>
                    </select>
                    <label for="floatingInputGrid">{{ __('Classification') }}</label>
                </div>
            </div>
            <div class="col-md m-auto">
                <div class="form-floating">
                    <select name="area_res_id" class="form-select text-capitalize" disabled>
                        <option value="{{ $violation->area_res->id }}" selected hidden>
                            {{ $violation->area_res->name }}
                        </option>
                        @foreach ($admins as $admin)
                        <option value="{{ $admin->id }}">{{ $admin->name }} ||
                            {{ $admin->title->title_name }}</option>
                        @endforeach
                    </select>
                    <label for="floatingInputGrid">{{ __('area responsible') }}</label>
                </div>
            </div>

            <div class="col-md m-auto">
                <div class="form-floating">
                    <input type="number" class="form-control text-capitalize" name="nearmiss" placeholder="near miss"
                        value="{{ $violation->nearmiss }}" disabled>
                    <label for="floatingInputGrid">{{ __('near miss') }}</label>
                </div>
            </div>
        </div>
        <hr class="mt-2">
        <div id="involvedWorkers">
            @foreach ($violation->involved_ids as $inv_id)
            <div class="row" id="involved">
                <div class="col-md" id="selectWorker">
                    <div class="form-floating p-1">
                        <div class="form-floating w-auto">
                            <select class="form-select text-capitalize" name="involved_ids[]" disabled>
                                <option class="text-capitalize" selected hidden disabled>{{ __('Involved Data') }}
                                </option>
                                @foreach ($workers as $worker)
                                <option class="text-capitalize" value="{{ $worker->id }}" @if ($worker->id == $inv_id)
                                    selected
                                    @endif>{{ $worker->id }} ||
                                    {{ $worker->name }}
                                </option>
                                @endforeach
                                @foreach ($unfixed_workers as $worker)
                                <option value="{{ $worker->id }}" @if ($worker->nid == $inv_id)
                                    selected
                                    @endif>{{ $worker->nid }} || {{ $worker->name }}</option>
                                @endforeach
                                <span class="menu-divider"></span>
                            </select>
                            <label for="floatingInput">{{ __('Involved Worker') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <br>
        <hr class="dropdown-divider bg-dark p-1 w-100">
        <h3 class="text-center m-3 w-100">{{ __('violation details') }}</h3>
        <!--  -->
        <div class="form-group col-md-6">
            <textarea class="form-control w-100 text-capitalize" rows="6" style="resize: none;"
                placeholder="description" name="description" disabled>{{ $violation->description}}</textarea>
        </div>
        <div class="form-group col-md-6">
            <textarea class="form-control w-100 text-capitalize" rows="6" style="resize: none;" placeholder="actions"
                name="action" disabled>{{ $violation->action}}</textarea>
        </div>
        <hr class="dropdown-divider bg-dark p-1 w-100">
        <h3 class="text-center m-3 w-100">{{ __('violation media') }}</h3>
        <div class="row">
            <div id="carouselExampleControlsNoTouching" class="carousel slide col-md-6" data-bs-touch="false"
                data-bs-interval="false">
                <div class="carousel-inner shadow-none mt-4">
                    <div class="row">
                        @foreach ($violation->gallery as $img)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src='{{ asset("public/media/violations/egy/images/$img") }}' style="height: 240px"
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
                <video class="w-100" src='{{ asset("public/media/violations/egy/video/$violation->video") }}'" controls
                    style=" height: 250px"></video>

            </div>
        </div>
    </div>
</div>
@endsection
