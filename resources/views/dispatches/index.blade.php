@extends('layouts.app')
@section('title')
{{__('Manage Network Switches')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
{{__('All Network Switches')}}
@endsection
@section('content')
@can('User Create')
<div class="row">
    <div class="col-lg-12 m-2">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('switch.create') }}">{{__('New Network Switch')}}</a>
        </div>
    </div>
</div>
@endcan
@include('layouts.sessions')
@include('layouts.errors')
<table class="table table-hover text-center">
    <tr>
        <th>{{__('id')}}</th>
        <th>{{__('Switch')}}</th>
        <th>{{__('Ports')}}</th>
        <th>{{__('Type')}}</th>
        <th>{{__('Location')}}</th>
        @can('View Switch U/P')
        <th>{{__('IP')}}</th>
        <th>{{__('Username')}}</th>
        <th>{{__('Password')}}</th>
        @endcan
        <th class="text-center">{{__('Action')}}</th>
    </tr>
    @foreach ($switches as $switch)
    <tr>
        <td>{{ $switch->id }}</td>
        <td>{{ $switch->name }}</td>
        <td>{{ $switch->ports}}</td>
        <td>{{ $switch->type}}</td>
        <td>{{ $switch->location}}</td>
        @can('View Switch U/P')
        <th>{{ $switch->ip}}</th>
        <th>{{ $switch->username}}</th>
        <th>{{ $switch->password}}</th>
        @endcan
        <td>
            <div class="dropdown text-center">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Switch Show')
                    <li><a class="dropdown-item" href="{{ route('switch.show',$switch->id) }}">Show</a></li>
                    @endcan
                    @can('Switch Edit')
                    <li><a class="dropdown-item" href="{{ route('switch.edit',$switch->id) }}">Edit</a></li>
                    @endcan
                    @can('Switch Delete')
                    <li><a class="dropdown-item" href="{{ route('switch.destroy',$switch->id) }}">Remove</a></li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
</table>

<div class="d-flex justify-content-center m-2">
    {{ $switches->links() }}
</div>
@endsection
