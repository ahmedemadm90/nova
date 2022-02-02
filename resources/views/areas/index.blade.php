@extends('layouts.app')
@section('title')
{{__('Manage Areas')}}
@endsection
@section('page-title')
{{__('Manage Areas')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
@push('style')
<style type="text/css">
    .my-active span {
        background-color: #5cb85c !important;
        color: white !important;
        border-color: #5cb85c !important;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@can('User Create')
<div class="row">
    <div class="col-lg-12 m-2">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('area.create') }}"> {{__('Create New Area')}}</a>
        </div>
    </div>
</div>
@endcan
@if ($message = Session::get('success'))
<div class="alert alert-success m-2">
    <p>{{ $message }}</p>
</div>
@endif
<table class="table table-hover m-auto text-center text-capitalize">
    <tr>
        <th>No</th>
        <th>{{__('Area Name')}}</th>
        <th>{{__('VP Name')}}</th>
        <th>{{__('Employees Incloded')}}</th>
        <th>{{__('Tools')}}</th>
    </tr>
    @foreach ($areas as $area)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $area->area_name }}</td>
        <td>{{ $area->vp->vp_name}}</td>
        <td>{{ $area->workers->count()}}</td>
        <td>
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Area Show')
                    <li><a class="dropdown-item" href="{{ route('area.show',$area->id) }}">Show</a></li>
                    @endcan
                    @can('Area Edit')
                    <li><a class="dropdown-item" href="{{ route('area.edit',$area->id) }}">Edit</a></li>
                    @endcan
                    @can('Area Delete')
                    <li><a class="dropdown-item" href="{{ route('area.destroy',$area->id) }}">Remove</a></li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-center m-2">
    {{ $areas->links() }}
</div>
@endsection
