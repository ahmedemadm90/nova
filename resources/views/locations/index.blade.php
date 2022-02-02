@extends('layouts.app')
@section('title')
{{__('Manage Plant Locations')}}
@endsection
@section('page-title')
{{__('Manage Plant Locations')}}
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
            <a class="btn btn-success" href="{{ route('location.create') }}">{{__('Create New Location')}}</a>
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
        <th>#</th>
        <th>{{__('Location Name')}}</th>
        <th>{{__('Country')}}</th>
        <th>{{__('Employees Incloded')}}</th>
        <th>{{__('Tools')}}</th>
    </tr>
    @foreach ($locs as $loc)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $loc->location_name }}</td>
        <td>{{ $loc->country->country_name}}</td>
        <td>{{ $loc->workers->count()}}</td>
        <td>
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Location Show')
                    <li><a class="dropdown-item" href="{{ route('location.show',$loc->id) }}">{{__('Show')}}</a></li>
                    @endcan
                    @can('Location Edit')
                    <li><a class="dropdown-item" href="{{ route('location.edit',$loc->id) }}">{{__('Edit')}}</a></li>
                    @endcan
                    @can('Location Delete')
                    <li><a class="dropdown-item" href="{{ route('location.destroy',$loc->id) }}">{{__('Remove')}}</a>
                    </li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-center m-2">
    {{ $locs->links() }}
</div>
@endsection
