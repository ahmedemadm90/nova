@extends('layouts.app')
@section('title')
{{__('HS Violation Classifications')}}
@endsection
@section('page-title')
{{__('HS Violation Classifications')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr>
@can('Title Create')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right m-2">
            <a class="btn btn-success" href="{{ route('classification.create') }}"> {{__('New Classifications')}}</a>
        </div>
    </div>
</div>
@endcan
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-hover w-75 m-auto text-center">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th width="280px" class="text-center">Action</th>
    </tr>
    @foreach ($types as $type)
    <tr>
        <td>{{ ++$i }}</td>
        <td class="text-capitalize">{{ $type->classification }}</td>
        <td>
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Classification Edit')
                    <li><a class="dropdown-item" href="{{ route('classification.edit',$type->id) }}">Edit</a></li>
                    @endcan
                    @can('Classification Delete')
                    <li><a class="dropdown-item" href="{{ route('classification.destroy',$type->id) }}">Remove</a></li>
                    @endcan
                    <li><a class="dropdown-item" href="{{ route('classification.edit',$type->id) }}">Edit</a></li>
                    <li><a class="dropdown-item" href="{{ route('classification.destroy',$type->id) }}">Remove</a></li>
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
