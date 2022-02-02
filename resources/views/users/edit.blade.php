@extends('layouts.app')
@section('title')
Edit User
@endsection
@section('page-title')
Edit User || <span class="text-danger">{{$user->name}}</span>
@endsection
@section('page-title-desc')
Edit <span class="text-danger">{{$user->name}}</span> Permissions
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')
<hr class="">
@include('layouts.sessions')
@include('layouts.errors')
<form class="form-floating text-center m-auto text-capitalize w-75" action="{{route('user.update',$user->id)}}"
    method="POST">
    @csrf
    <div class="row m-auto p-1">
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="name" name="id" value="{{ $user->id }}">
                <label for="floatingInputGrid">{{__('iD')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="name" name="name"
                    value="{{$user->name}}">
                <label for="floatingInputGrid">{{__('name')}}</label>
            </div>
        </div>
        <div class="col-md m-auto">
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingInput" placeholder="user password"
                    name="password">
                <label for="floatingInput">{{ __('password') }}</label>
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
                <input type="email" class="form-control" id="floatingInput" placeholder="user email" name="email"
                    value="{{$user->email}}">
                <label for="floatingInput">{{__('email')}}</label>
            </div>
        </div>
    </div>
    <div class="row m-auto p-1">
        <div class="col m-auto">
            <div class="form-floating">
                <select class="form-select text-capitalize" name="status">
                    <option value="{{$user->state}}" class="text-capitalize" selected hidden>{{$user->state}}</option>
                    <option value="active" class="text-capitalize">active</option>
                    <option value="disabled" class="text-capitalize">disabled</option>
                </select>
                <label for="floatingInput">State</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col m-auto">
            @foreach ($groups as $group)
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" value="{{$group->id}}"
                    name="groups[]"{{--  @if (in_array($group->id,$user->groups))
                checked
                @endif --}}>
                <label class="form-check-label" for="flexSwitchCheckChecked">{{$group->group_name}}</label>
            </div>
            @endforeach
        </div>
    </div>
    <hr class="w-100 p-1">
    <div class="row m-3">
        <h2 class="text-center">Roles</h2>
        @foreach($roles as $role)
        <div class="form-check form-check-inline form-switch col-md-3 text-capitalize m-auto">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="roles[]" value="{{$role}}"
                @if (in_array($role,$userRole)) checked @endif>
            <label class="form-check-label" for="flexSwitchCheckChecked">{{$role}}</label>
        </div>
        @endforeach
    </div>
    {{--  --}}
    <hr class="w-100 p-1">
    <div class="col m-auto">
        <div class="form-floating m-2">
            <button class="btn btn-success text-capitalize"> {{__('Submit')}}</button>
        </div>
    </div>
</form>
@endsection
