@extends('layouts.app')
@section('title')
Manage Admin Groups
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
All Permits Admin Groups
@endsection
@section('page-title-desc')
Manage Permits Admin Groups
@endsection
@section('content')
<hr>
@can('User Create')
<div class="row">
    <div class="col-lg-12 m-2">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('group.create') }}"> Create New Group</a>
        </div>
    </div>
</div>
@endcan
@if ($message = Session::get('success'))
<div class="alert alert-success m-2">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-hover  text-capitalize text-center">
    <tr>
        <th>No</th>
        <th>Group Name</th>
        <th>Action</th>
    </tr>
    @foreach ($groups as $group)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $group->group_name }}</td>

        <td>
            <div class="dropdown text-center">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Group Show')
                    <li><a class="dropdown-item" href="{{ route('group.show',$group->id) }}">Show</a></li>
                    @endcan
                    @can('Group Edit')
                    <li><a class="dropdown-item" href="{{ route('group.edit',$group->id) }}">Edit</a></li>
                    @endcan
                    @can('Group Delete')
                    <li><a class="dropdown-item" href="{{ route('group.destroy',$group->id) }}">Remove</a></li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-center m-2">
    {{ $groups->links() }}
</div>
@endsection
