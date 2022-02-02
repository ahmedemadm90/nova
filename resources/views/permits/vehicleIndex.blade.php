@extends('layouts.app')
@section('title')
Manage Vehicle Permits
@endsection
@section('page-title')
All Vehicle Permits
@endsection
@section('page-title-desc')
All Vehicle Permits Has The State Of <span class="text-danger">Waitting</span>
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
                <tr class="row text-center">
                    <th class="col-1">permit type</th>
                    <th class="col-1">start date</th>
                    <th class="col-1">end date</th>
                    <th class="col-2">drivers</th>
                    <th class="col-2">drivers IDs</th>
                    <th class="col-1">IDs Type</th>
                    <th class="col-2">phones</th>
                    <th class="col-1">status</th>
                    <th class="col-1">actions</th>
                </tr>
            </thead>
            <tbody id="">
                @foreach ($permits as $permit)

                <tr class="row text-center">
                    <td class="text-capitalize col-1">{{$permit->type}}</td>
                    <td class=" text-capitalize col-1">
                        <label class="badge bg-success">{{$permit->date_from}}</label></td>
                    <td class=" text-capitalize col-1">
                        <label class="badge bg-danger">{{$permit->date_to}}</label></td>
                    <td class="text-capitalize col-2">
                        @foreach ($permit->vehicle_drivers as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td>
                    <td class="text-capitalize col-2">
                        @foreach ($permit->vehicle_drivers_id as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td>
                    <td class="text-capitalize col-1">
                        @foreach ($permit->drivers_id_types as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td>
                    <td class="text-capitalize col-2">
                        @foreach ($permit->drivers_phones as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td>
                    <td class="text-capitalize col-1">{{$permit->vehicle_clr}}</td>
                    <td class="text-capitalize col-1">
                        <div class="dropdown">
                            <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                                @can('Permit Show')
                                <li><a href="{{route('permits.show',$permit->id)}}" class="dropdown-item"
                                        target="_blank">Show</a>
                                </li>
                                @endcan
                                @can('Permit Edit')
                                <li><a href="{{route('permits.approve',$permit->id)}}" class="dropdown-item">Edit</a>
                                </li>
                                @endcan
                                @can('Permit Delete')
                                <li><a href="{{route('permits.refuse',$permit->id)}}" class="dropdown-item">Reject</a>
                                </li>
                                @endcan
                            </ul>
                        </div>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center m-2">
            {{ $permits->links() }}
        </div>
    </div>
</div>
@endsection
