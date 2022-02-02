@extends('layouts.app')
@section('title')
Manage Users
@endsection
@section('page-title')
Manage Users
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title-desc')
Manage Users Who Uses The Web App
@endsection
@section('content')
<hr class="">
@can('User Create')
<div class="row">
    <div class="col-lg-12 m-2">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('user.create') }}"> Create New User</a>
        </div>
    </div>
</div>
@endcan
@if ($message = Session::get('success'))
<div class="alert alert-success m-2">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-hover m-2 text-center">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Roles</th>
        <th>State</th>
        <th>Admin Group</th>
        <th>Action</th>
    </tr>
    @foreach ($data as $key => $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
            <label class="badge bg-success text-capitalize m-1">{{ $v }}</label>
            @endforeach
            @endif
        </td>
        <td class="text-capitalize">
            @if ($user->state == 'active')
            <label for="" class="badge bg-success text-capitalize">{{$user->state}}</label>
            @else
            <label for="" class="badge bg-danger text-capitalize">{{$user->state}}</label>
            @endif
        </td>
        <td class="text-capitalize">
            @if (isset($user->groups))
            @foreach ($user->groups as $id)
            <label for=""
                class="badge bg-info text-capitalize m-1">{{$user->group($id)->group_name ?? 'User Is Not In Any Groups'}}</label>
            @endforeach
            @endif
        </td>
        <td>
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('User Show')
                    <li><a class="dropdown-item" href="{{ route('user.show',$user->id) }}">Show</a></li>
                    @endcan
                    @can('User Edit')
                    <li><a class="dropdown-item" href="{{ route('user.edit',$user->id) }}">Edit</a></li>
                    @endcan
                    @can('User Delete')
                    <li><a class="dropdown-item" href="{{ route('user.destroy',$user->id) }}">Remove</a></li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
</table>

<div class="d-flex justify-content-center m-2">
    {{ $data->links() }}
</div>
@endsection
