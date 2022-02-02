@extends('layouts.app')
@section('title')
Expiring Permits Today
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('page-title')
Permits Expiring Today
@endsection
@section('content')
<table class="table table-hover text-center m-auto text-capitalize">
    <thead>
        <tr class="row">
            <th class="col-md">permit type</th>
            <th class="col-md">start date</th>
            <th class="col-md">end date</th>
            <th class="col-md">drivers</th>
            <th class="col-md">drivers IDs</th>
            <th class="col-md">IDs Type</th>
            <th class="col-md">phones</th>
        </tr>
    </thead>
    <tbody id="">
        @foreach ($permits as $permit)

        <tr class="row">
            <td class="text-capitalize col-md">{{$permit->type}}</td>
            <td class="text-capitalize col-md badge-success">
                <label class="badge bg-success">{{$permit->date_from}}</label>
            </td>
            <td class="text-capitalize col-md">
                <label class="badge bg-danger">{{$permit->date_to}}</label>
            </td>
            <td class="text-capitalize col-md">
                @foreach ($permit->vehicle_drivers as $driver)
                {{$driver}}<br>
                @endforeach
            </td>
            <td class="text-capitalize col-md">
                @foreach ($permit->vehicle_drivers_id as $driver)
                {{$driver}}<br>
                @endforeach
            </td>
            <td class="text-capitalize col-md">
                @foreach ($permit->drivers_id_types as $driver)
                {{$driver}}<br>
                @endforeach
            </td>

            <td class="text-capitalize col-md">
                @foreach ($permit->drivers_phones as $driver)
                {{$driver}}<br>
                @endforeach
            </td>
        </tr>

        @endforeach
    </tbody>
</table>
@endsection
