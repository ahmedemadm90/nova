@extends('layouts.app')
@section('title')
Manage My Team Requests
@endsection
@section('page-title')
Manage My Team Private Vehicles Permit Requests
@endsection
@section('page-title')
Permits Was Requested By A User In Your Group
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="w-100 bg-dark">
<div class="row">
    <div class="col border-left">
        <table class="table table-hover text-center m-auto w-100 text-capitalize">
            <thead>
                <tr class="row">
                    <th class="col-md">permit type</th>
                    <th class="col-md">start date</th>
                    <th class="col-md">end date</th>
                    {{-- <th class="col-md-2">drivers</th>
                            <th class="col-md-2">drivers IDs</th>
                            <th class="col-md-2">IDs Type</th>
                            <th class="col-md-2">phones</th> --}}
                    <th class="col-md-2">Color</th>
                    <th class="col-md-2">Requested By</th>
                    <th class="col-md-2">actions</th>
                </tr>
            </thead>
            <tbody id="">
                @foreach ($permits as $permit)
                <tr class="row">
                    <td class="text-capitalize col-md">{{$permit->type}}</td>
                    <td class="text-capitalize col-md">
                        <label class="badge bg-success">{{$permit->date_from}}</label></td>
                    <td class="text-capitalize col-md">
                        <label class="badge bg-danger">{{$permit->date_to}}</label></td>
                    {{-- <td class=" text-capitalize col-md-2">
                                @foreach ($permit->vehicle_drivers as $driver)
                                {{$driver}}<br>
                    @endforeach
                    </td>
                    <td class="text-capitalize col-md-2">
                        @foreach ($permit->vehicle_drivers_id as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td>
                    <td class="text-capitalize col-md-2">
                        @foreach ($permit->drivers_id_types as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td>
                    <td class="text-capitalize col-md-2">
                        @foreach ($permit->drivers_phones as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td> --}}

                    <td class="text-capitalize col-md">{{$permit->vehicle_clr}}</td>
                    <td class="text-capitalize col-md">
                        {{$permit->user->name}}
                    </td>
                    <td class="text-capitalize col-md">
                        <div class="dropdown">
                            <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                                @can('Permit Show')
                                <li><a href="{{route('permit.show',$permit->id)}}" class="dropdown-item">Show</a></li>
                                @endcan
                                @can('Permit Approve')
                                <li><a href="{{route('permit.approve',$permit->id)}}" class="dropdown-item">Approve</a>
                                </li>
                                @endcan
                                @can('Permit Reject')
                                <li><a href="{{route('permit.refuse',$permit->id)}}" class="dropdown-item">Reject</a>
                                </li>
                                @endcan
                            </ul>
                        </div>
                        @can('Permit Approve')

                        @endcan
                        @can('Permit Reject')
                        <a href="{{route('permit.refuse',$permit->id)}}" class="btn btn-danger"></a>
                        @endcan
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <div class="p-2 text text-decoration-none text-center">
        </div>
    </div>
</div>
@endsection
