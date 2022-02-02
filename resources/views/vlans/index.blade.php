@extends('layouts.app')
@section('title')
{{__('Manage Network Vlans')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
{{__('Manage Network Vlans')}}
@endsection
@section('content')
@can('User Create')
<div class="row">
    <div class="col-lg-12 m-2">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('vlan.create') }}">{{__('Create New Vlan')}}</a>
        </div>
    </div>
</div>
@endcan
@include('layouts.sessions')
<table class="table table-hover  text-capitalize text-center">
    <tr>
        <th>{{__('Vlan')}}</th>
        <th>{{__('Switch')}}</th>
        <th>{{__('Gateway')}}</th>
        <th>{{__('Start IP')}}</th>
        <th>{{__('End IP')}}</th>
        <th>{{__('Cameras')}}</th>
        <th>{{__('Active')}}</th>
        <th>{{__('Actions')}}</th>
    </tr>
    @foreach ($vlans as $vlan)
    <tr>
        <td>{{ $vlan->name }}</td>
        <td>{{ $vlan->switch->name }}</td>
        <td>{{ $vlan->gateway }}</td>
        <td>{{ $vlan->start_ip }}</td>
        <td>{{ $vlan->end_ip }}</td>
        <td>{{ $vlan->cameras($vlan->id)}}</td>
        <td>
            @if ($vlan->active == 1)
            <span class='badge bg-success'>{{__('Active')}}</span>
            @else
            <span class='badge bg-danger'>{{__('Disabled')}}</span>
            @endif
        </td>
        <td>
            <div class="dropdown text-center">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Vlan Show')
                    <li><a class="dropdown-item" href="{{ route('vlan.show',$vlan->id) }}">{{__('Show')}}</a></li>
                    @endcan
                    @can('Vlan Edit')
                    <li><a class="dropdown-item" href="{{ route('vlan.edit',$vlan->id) }}">{{__('Edit')}}</a></li>
                    @endcan
                    @can('Vlan Delete')
                    <li><a class="dropdown-item" href="{{ route('vlan.destroy',$vlan->id) }}">{{__('Remove')}}</a></li>
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
    {{ $vlans->links() }}
</div>
@endsection
