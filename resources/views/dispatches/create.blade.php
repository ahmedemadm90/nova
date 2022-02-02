@extends('layouts.app')
@section('title')
{{__('Add New Switch')}}
@endsection
@section('page-title')
{{__('New Switch')}}
@endsection
@section('page-title-desc')
{{__('Add New Network Switch')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="w-100 bg-dark">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('switches.index') }}">{{__('Back')}}</a>
        </div>
    </div>
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="col border-right">
        <form class="form-floating text-center col-md-10 m-auto" action="{{route('switch.store')}}" method="POST">
            @csrf
            <div class="row m-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize" id="floatingInput" placeholder="switch"
                            name="name">
                        <label for="floatingInput">{{__('Switch')}}</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="number" class="form-control text-capitalize" id="floatingInput"
                            placeholder="switch" name="ports">
                        <label for="floatingInput">{{__('Ports')}}</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select text-capitalize" name="type">
                            <option value="" selected hidden disabled>{{__('Select Switch type')}}</option>
                            <option value="ip fixed">{{__('IP Fixed')}}</option>
                            <option value="analog">{{__('Analog')}}</option>
                        </select>
                        <label for="floatingInput">{{__('Type')}}</label>
                    </div>
                </div>
            </div>
            <div class="row m-2">
                <div class="col-md">
                    <div class="form-floating">
                        <div class="form-floating col-md">
                            <input type="text" class="form-control text-capitalize" id="floatingInput"
                                placeholder="location" name="location">
                            <label for="floatingInput">{{__('Location')}}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <div class="form-floating col-md">
                            <input type="text" class="form-control" id="floatingInput" placeholder="location" name="ip">
                            <label for="floatingInput">{{__('IP')}}</label>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row m-2">
                <div class="col-md">
                    <div class="form-floating">
                        <div class="form-floating col-md">
                            <input type="text" class="form-control" id="floatingInput" placeholder="location"
                                name="username">
                            <label for="floatingInput">{{__('Username')}}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <div class="form-floating col-md">
                            <input type="text" class="form-control" id="floatingInput" placeholder="location"
                                name="password">
                            <label for="floatingInput">{{__('Password')}}</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row m-2">
                <div class="col-md-2 m-auto">
                    <div class="form-check form-switch fs-3">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" value="1"
                            name="active">
                        <label class="form-check-label" for="flexSwitchCheckDefault">{{__('Active')}}</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-success">
                {{__('Add')}}</button>
        </form>
    </div>
</div>

@endsection
