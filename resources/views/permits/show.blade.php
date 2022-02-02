@extends('layouts.master')
@section('title')
Permits Detalis
@endsection
@section('cards')
@include('layouts.contentheader')
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('footer')
@include('layouts.footer')
@endsection
@section('content')
<hr class="w-100 bg-dark">
<div class="row">
    <div class="col border-left">
        <table class="table table-condensed bg-light text-center m-auto w-100 text-capitalize">
            <thead>
                <tr class="row">
                    <th class="col-md">permit type</th>
                    <th class="col-md">start date</th>
                    <th class="col-md">end date</th>
                    <th class="col-md">drivers</th>
                    <th class="col-md">drivers IDs</th>
                    <th class="col-md">IDs Type</th>
                    <th class="col-md">phones</th>
                    <th class="col-md">status</th>
                </tr>
            </thead>
            <tbody id="">
                <tr class="row">
                    <td class="text-capitalize col-md">{{$permit->type}}</td>
                    <td class="text-capitalize col-md">
                        <label class="badge badge-success">{{$permit->date_from}}</label>
                    </td>
                    <td class="text-capitalize col-md">
                        <label class="badge badge-danger">{{$permit->date_to}}</label>

                    </td>
                    <td class="text-capitalize col-md">
                        @foreach ((explode(',',$permit->vehicle_drivers)) as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td>
                    <td class="text-capitalize col-md">
                        @foreach ((explode(',',$permit->vehicle_drivers_id)) as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td>
                    <td class="text-capitalize col-md">
                        @foreach ((explode(',',$permit->drivers_id_types)) as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td>

                    <td class="text-capitalize col-md">
                        @foreach ((explode(',',$permit->drivers_phones)) as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td>
                    <td class="text-capitalize col-md">{{$permit->vehicle_clr}}</td>

                </tr>
            </tbody>
        </table>
        <div class="p-2 text text-decoration-none text-center">
        </div>
    </div>
</div>
@endsection
