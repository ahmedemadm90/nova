@extends('layouts.app')
@section('title')
Workers Title
@endsection
@section('page-title')
Workers Title
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title-desc')
All Workers Titles
@endsection
@section('content')
<hr>
@can('Title Create')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right m-2">
            <a class="btn btn-success" href="{{ route('title.create') }}"> Create New Title</a>
        </div>
    </div>
</div>
@endcan
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-hover w-75 m-auto">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th width="280px" class="text-center">Action</th>
    </tr>
    @foreach ($titles as $title)
    <tr>
        <td>{{ ++$i }}</td>
        <td class="text-capitalize">{{ $title->title_name }}</td>
        <td>
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Title Edit')
                    <li><a class="dropdown-item" href="{{ route('title.edit',$title->id) }}">Edit</a></li>
                    @endcan
                    @can('Title Delete')
                    <li><a class="dropdown-item" href="{{ route('title.destroy',$title->id) }}">Remove</a></li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
</table>

<div class="d-flex justify-content-center m-2">
    {{ $titles->links() }}
</div>

@endsection
