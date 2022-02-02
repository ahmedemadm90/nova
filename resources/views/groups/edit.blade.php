@extends('layouts.app')
@section('title')
Edit Group
@endsection
@section('page-title')
Edit Admin Group || <span class="text-danger">{{$group->group_name}}</span>
@endsection
@section('page-title-desc')
Add Or Remove Users To This Admin Group
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="w-100 bg-dark">
@include('layouts.errors')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('groups.index') }}">Back</a>
        </div>
    </div>
    <div class="col border-right">
        <form class="form-floating text-center col-md-8 m-auto" action="{{route('group.update',$group->id)}}"
            method="POST">
            @csrf
            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control" id="floatingInput" placeholder="Group Name" name="group_name"
                    value="{{$group->group_name}}">
                <label for="floatingInput">Group Name</label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group mt-3">
                    <h3 class="text-center mb-2 text-capitalize">{{__('Users')}}</h3>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group text-center">
                            <br>
                            @foreach($users as $user)
                            <div class="form-check form-check-inline form-switch col-md-3 text-capitalize">
                                <input class="form-check-input" type="checkbox" name="users_id[]"
                                    value="{{ $user->id }}" @if (in_array($user->id,$group->users_id)) checked @endif>
                                <label class="form-check-label">{{ $user->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <hr>
            <button class="btn btn-success">
                Update</button>
        </form>
    </div>
</div>

@endsection
