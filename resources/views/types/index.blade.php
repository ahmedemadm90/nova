@extends('layouts.app')
@section('title')
Manage Workers Types
@endsection
@section('page-title')
Workers Types
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title-desc')
Shows Types Can Be Assigned To Workers
@endsection
@section('content')
<hr class="">
@can('Role Create')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right m-2">
            <a class="btn btn-success" href="{{ route('type.create') }}"> Create New Type</a>
        </div>
    </div>
</div>
@endcan
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-hover text-center">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    @foreach ($types as $type)
    <tr>
        <td>{{ ++$i }}</td>
        <td class="text-capitalize">{{ $type->type_name }}</td>
        <td>
            <div class="dropdown text-center">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Type Edit')
                    <li><a class="dropdown-item" href="{{ route('type.edit',$type->id) }}">Edit</a></li>
                    @endcan
                    @can('Type Delete')
                    <li><a class="dropdown-item" href="{{ route('type.destroy',$type->id) }}">Remove</a></li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-center m-2">
    {{ $types->links() }}
</div>
@endsection
