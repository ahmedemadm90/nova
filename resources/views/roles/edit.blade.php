@extends('layouts.app')
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
Edit Role || <span class="text-danger">{{$role->name}}</span>
@endsection
@section('page-title-desc')
Change Role || <span class="text-danger">{{$role->name}}</span> Name And <span class="text text-danger">OR</span> Edit
Role Permission
<hr>
@endsection
@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
        </div>
    </div>
</div>{!! Form::model($role, ['method' => 'PATCH','route' => ['role.update', $role->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-floating">
            <input type="name" class="form-control" id="floatingInput" placeholder="role name" name="name"
                value="{{$role->name}}">
            <label for="floatingInput">{{__('Name')}}</label>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group text-center">
            <h3>Permission:</h3>
            <br>
            @foreach($permission as $value)
            <div class="form-check form-check-inline form-switch col-md-3 text-capitalize m-auto">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="permission[]"
                    value="{{$value->id}}" @if (in_array($value->id,$rolePermissions)) checked @endif>
                <label class="form-check-label" for="flexSwitchCheckChecked">{{$value->name}}</label>
            </div>
            @endforeach

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
    @endsection
