@extends('layouts.app')
@section('title')
Create User
@endsection
@section('page-title')
Create New User
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title-desc')
Create New User To Manage System
@endsection
@section('content')
<hr class="">
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}">Back</a>
        </div>
    </div>
</div>
@include('layouts.sessions')
@include('layouts.errors')

<form class="form-floating text-center m-auto text-capitalize w-75" action="{{route('user.store')}}" method="POST">
    @csrf
    <div class="row m-auto p-1">
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="name" name="id">
                <label for="floatingInputGrid">{{__('iD')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="name" name="name">
                <label for="floatingInputGrid">{{__('name')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingInput" placeholder="user password"
                    name="password">
                <label for="floatingInput">password</label>
            </div>
        </div>
    </div>
    <div class="row m-auto p-1">
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingInput" placeholder="confirm-password"
                    name="confirm-password">
                <label for="floatingInput">{{__('confirm-password')}}</label>
            </div>
        </div>
        <div class="col m-auto">
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="user email" name="email">
                <label for="floatingInput">{{__('email')}}</label>
            </div>
        </div>
    </div>
    <div class="row m-auto p-1">
        <div class="col m-auto">
            <div class="form-floating">
                <select class="form-select text-capitalize" name="status">
                    <option value="" class="text-capitalize" disabled selected hidden>{{__('user account state')}}
                    </option>
                    <option value="active" class="text-capitalize">{{__('active')}}</option>
                    <option value="disabled" class="text-capitalize">{{__('disabled')}}</option>
                </select>
                <label for="floatingInput">{{__('State')}}</label>
            </div>
        </div>
        {{-- <div class="col m-auto">
            <div class="form-floating">
                <select class="form-select text-capitalize" name="group[]">
                    <option value="" class="text-capitalize" selected hidden>{{__('admin group')}}</option>
        @foreach ($groups as $group)
        <option value="{{$group->id}}" class="text-capitalize">{{$group->group_name}}</option>
        @endforeach
        </select>
        <label for="floatingInput">Group</label>
    </div>
    </div> --}}
    </div>
    <hr class="w-100 p-1">
    <h2>{{__('Groups')}}</h2>
    <div class="row">
        <div class="m-auto">
            @foreach ($groups as $group)
            <div class="form-check form-check-inline form-switch col-md-3 text-capitalize m-auto">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" value="{{$group->id}}" name="groups[]">
                <label class="form-check-label" for="flexSwitchCheckChecked">{{$group->group_name}}</label>
            </div>
            @endforeach
        </div>
    </div>
    <hr class="w-100 p-1">
    <div class="col-md m-auto">
        <h2>Roles</h2>
        @foreach($roles as $role)
        <div class="form-check form-check-inline form-switch col-md-3 text-capitalize m-auto">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="roles[]"
                value="{{$role}}">
            <label class="form-check-label" for="flexSwitchCheckChecked">{{$role}}</label>
        </div>
        @endforeach
    </div>
    {{--  --}}
    <hr class="w-100 p-1">
    <div class="col m-auto">
        <div class="form-floating m-2">
            <button class="btn btn-success text-capitalize">
                <i class="fas fa-plus-square m-2"></i> Add</button>
        </div>
    </div>
</form>
@endsection
