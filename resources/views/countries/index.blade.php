@extends('layouts.app')
@section('title')
{{__('Manage Cemex Countries')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
{{__('Manage Cemex Countries')}}
@endsection
@section('content')
@can('User Create')
<div class="row">
    <div class="col-lg-12 m-2">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('country.create') }}"> {{__('Create New Country')}}</a>
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
        <th>#</th>
        <th>{{__('Country Name')}}</th>
        <th>{{__('Employees Incloded')}}</th>
        <th class="text-center">{{__('Tools')}}</th>
    </tr>
    @foreach ($countries as $country)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $country->country_name }}</td>
        <td>{{ $country->employees->count()}}</td>
        <td>
            <div class="dropdown text-center">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Country Show')
                    <li><a class="dropdown-item" href="{{ route('country.show',$country->id) }}">Show</a></li>
                    @endcan
                    @can('Country Edit')
                    <li><a class="dropdown-item" href="{{ route('country.edit',$country->id) }}">Edit</a></li>
                    @endcan
                    @can('Country Delete')
                    <li><a class="dropdown-item" href="{{ route('country.destroy',$country->id) }}">Remove</a></li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-center m-2">
    {{ $countries->links() }}
</div>
@endsection
