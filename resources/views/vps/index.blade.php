@extends('layouts.app')
@section('title')
Manage VPs
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
All Plant VPs
@endsection
@section('page-title-desc')
Manage Plant VPs
@endsection
@section('content')
@can('User Create')
<div class="row">
    <div class="col-lg-12 m-2">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('vp.create') }}"> Create New VP</a>
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
        <th>VP Name</th>
        <th>Areas Incloded</th>
        <th>Employees Incloded</th>
        <th class="text-center">Action</th>
    </tr>
    @foreach ($vps as $vp)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $vp->vp_name }}</td>
        <td>{{ $vp->area->count()}}</td>
        <td>{{ $vp->workers->count()}}</td>
        <td>
            <div class="dropdown text-center">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('VP Show')
                    <li><a class="dropdown-item" href="{{ route('vp.show',$vp->id) }}">Show</a></li>
                    @endcan
                    @can('VP Edit')
                    <li><a class="dropdown-item" href="{{ route('vp.edit',$vp->id) }}">Edit</a></li>
                    @endcan
                    @can('VP Delete')
                    <li><a class="dropdown-item" href="{{ route('vp.destroy',$vp->id) }}">Remove</a></li>
                    @endcan
                </ul>
            </div>
        </td>
        {{-- <td class="text-center">
            @can('VPs List')
            <a class="btn btn-info" href="{{ route('vp.show',$vp->id) }}">
        <i class="fas fa-eye mr-1"></i></a>
        @endcan
        <a class="btn btn-primary" href="{{ route('vp.edit',$vp->id) }}">
            <i class="fas fa-edit"></i></a>
        <a class="btn btn-danger" href="{{ route('vp.destroy',$vp->id) }}">
            <i class="fas fa-trash"></i></a>
        </td> --}}
    </tr>
    @endforeach
</table>

<div class="d-flex justify-content-center m-2">
    {{ $vps->links() }}
</div>
@endsection
