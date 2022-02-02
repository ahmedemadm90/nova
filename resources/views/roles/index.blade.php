@extends('layouts.app')
@section('title')
Manage Roles
@endsection
@section('page-title')
All System Roles
@endsection
@section('page-title-desc')
All Roles Can Be Assigned To Users
@endsection
@section('content')
@can('Role Create')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right m-2">
            <a class="btn btn-success" href="{{ route('role.create') }}"> Create New Role</a>
        </div>
    </div>
</div>
@endcan
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-hover m-auto text-center">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th class="text-center">Action</th>
    </tr>
    @foreach ($roles as $key => $role)

    <tr>
        <td>{{ ++$i }}</td>
        <td class="text-capitalize">{{ $role->name }}</td>
        <td>
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ route('role.destroy',$role->id) }}">Remove</a></li>
                    <li><a class="dropdown-item" href="{{ route('role.edit',$role->id) }}">Edit</a></li>
                    <li><a class="dropdown-item" href="{{ route('role.show',$role->id) }}">Show</a></li>
                </ul>
            </div>
        </td>
        {{-- <td class="text-center">
            <a class="btn btn-info" href="{{ route('role.show',$role->id) }}"><i class="fas fa-eye"></i></a>
        @can('Role Edit')
        <a class="btn btn-primary" href="{{ route('role.edit',$role->id) }}"><i class="fas fa-edit"></i></a>
        @endcan
        @can('Role Delete')
        <a class="btn btn-danger" href="{{route('role.destroy',$role->id)}}">
            <i class="fas fa-trash"></i>
        </a>
        @endcan
        </td> --}}
    </tr>
    @endforeach
</table>

<div class="d-flex justify-content-center m-2">
    {{ $roles->links() }}
</div>

@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('header')
@include('layouts.header')
@endsection
