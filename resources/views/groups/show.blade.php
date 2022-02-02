@extends('layouts.app')
@section('title')
Show Group
@endsection
@section('page-title')
Show Admin Group || <span class="text-danger">{{$group->group_name}}</span>
@endsection
@section('page-title-desc')
Show Information Of Admin Group <span class="text-danger">{{$group->group_name}}</span>
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('groups.index') }}"> Back</a>
        </div>
    </div>
</div>

<table class="table table-hover  text-capitalize text-center">
    <tr>
        <th>Group Name</th>
        <th>Users ID</th>
    </tr>
    <tr>

        <td>{{ $group->group_name }}</td>
        {{-- <td>{{ $group->testusers($group->id) }}</td> --}}
        <td>
            @foreach ($group->users($group->id) as $user)
            <label class="badge bg-success">{{$user->name}}</label>
            @endforeach
        </td>

    </tr>

</table>

{{-- <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $group->group_name }}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>Users:</strong>
        @if(!empty($group->users_id))
        @foreach($group->users_id as $v)
        <label class="badge bg-success">{{ $v }}</label><br>
        @endforeach
        @endif
    </div>
</div>
</div> --}}
@endsection
