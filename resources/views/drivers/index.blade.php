@extends('layouts.app')
@section('title')
{{__('All Drivers')}}
@endsection
@section('page-title')
{{__('All Drivers')}}
@endsection
@section('page-title-desc')
{{__('Manage Service Drivers In Plant')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="">
@can('User Create')
<div class="row">
    <div class="col-lg-12 m-2">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('driver.create') }}"> {{__('Create New Driver')}}</a>
        </div>
    </div>
</div>
@endcan
@include('layouts.sessions')
<table class="table table-hover m-auto text-center text-capitalize">
    <tr>
        <th>#</th>
        <th>{{__('Driver Name')}}</th>
        <th>{{__('Driver License')}}</th>
        <th>{{__('Driver License Number')}}</th>
        <th>{{__('State')}}</th>
        <th>{{__('Actions')}}</th>
    </tr>
    @foreach ($drivers as $driver)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $driver->name }}</td>
        <td>{{ $driver->license_level }}</td>
        <td>{{ $driver->license_number }}</td>
        <td>
            @if ($driver->state == 'Allowed')
            <span class="badge bg-success">{{$driver->state}}</span>
            @else
            <span class="badge bg-danger">{{$driver->state}}</span>
            @endif
            {{-- {{ $driver->state }}</td> --}}
        <td>
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Driver Show')
                    <li><a class="dropdown-item" href="{{ route('driver.show',$driver->id) }}">Show</a></li>
                    @endcan
                    @can('Driver Edit')
                    <li><a class="dropdown-item" href="{{ route('driver.edit',$driver->id) }}">Edit</a></li>
                    @endcan
                    @can('Driver Delete')
                    <li><a class="dropdown-item" href="{{ route('driver.destroy',$driver->id) }}">Remove</a></li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-center m-2">
    {{ $drivers->links() }}
</div>
@endsection
