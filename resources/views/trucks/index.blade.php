@extends('layouts.app')
@section('title')
{{__('Manage Trucks')}}
@endsection
@section('page-title')
{{__('Manage Trucks')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr>
@can('Hauler Create')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right m-2">
            <a class="btn btn-success" href="{{ route('truck.create') }}"> {{__('New Truck')}}</a>
        </div>
    </div>
</div>
@endcan
@include('layouts.sessions')
<table class="table table-hover w-75 m-auto text-center text-capitalize">
    <tr>
        <th>#</th>
        <th>{{__('Truck NO.')}}</th>
        <th>{{__('Hauler')}}</th>
        <th>{{__('State')}}</th>
        <th class="text-center">{{__('Action')}}</th>
    </tr>
    @foreach ($trucks as $truck)
    <tr>
        <td>{{ ++$i }}</td>
        <td class="text-capitalize">{{ $truck->truck_no }}</td>
        <td class="text-capitalize">
            @if ($truck->state == 'allowed')
            <span class="badge bg-success">{{$truck->state}}</span>
            @elseif($truck->state == 'suspended')
            <span class="badge bg-info">{{$truck->state}}</span>
            @elseif($truck->state == 'blacklisted')
            <span class="badge bg-danger">{{$truck->state}}</span>

            @endif
        </td>
        <td class="text-capitalize">{{ $truck->hauler->name }}</td>
        <td>
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Truck Edit')
                    <li><a class="dropdown-item" href="{{ route('truck.edit',$truck->id) }}">Edit</a></li>
                    @endcan
                    @can('Truck Delete')
                    <li><a class="dropdown-item" href="{{ route('truck.destroy',$truck->id) }}">Remove</a></li>
                    @endcan
                </ul>
            </div>
        </td>
        </td>
    </tr>
    @endforeach
</table>

<div class="d-flex justify-content-center m-2">
    {{ $trucks->links() }}
</div>

@endsection
