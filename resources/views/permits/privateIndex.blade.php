@extends('layouts.master')
@section('title')
Manage Private Permits
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
                    <th class="col-1">permit type</th>
                    <th class="col-1">start date</th>
                    <th class="col-1">end date</th>
                    <th class="col-1">drivers</th>
                    <th class="col-2">drivers IDs</th>
                    <th class="col-1">IDs Type</th>
                    <th class="col-1">phones</th>
                    <th class="col-1">state</th>
                    <th class="col-1">Company</th>
                    <th class="col-1">Color</th>
                    <th class="col-1">actions</th>
                </tr>
            </thead>
            <tbody id="">
                @foreach ($permits as $permit)

                <tr class="row">
                    <td class="text-capitalize col-1">{{$permit->type}}</td>
                    <td class="text-capitalize col-1 badge-success">
                        <label class="badge badge-success">{{$permit->date_from}}</label>
                    </td>
                    <td class="text-capitalize col-1">
                        <label class="badge badge-danger">{{$permit->date_to}}</label>
                    </td>
                    <td class="text-capitalize col-1">
                        @foreach ((explode(',',$permit->vehicle_drivers)) as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td>
                    <td class="text-capitalize col-2">
                        @foreach ((explode(',',$permit->vehicle_drivers_id)) as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td>
                    <td class="text-capitalize col-1">
                        @foreach ((explode(',',$permit->drivers_id_types)) as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td>

                    <td class="text-capitalize col-1">
                        @foreach ((explode(',',$permit->drivers_phones)) as $driver)
                        {{$driver}}<br>
                        @endforeach
                    </td>
                    <td class="text-capitalize col-1">
                        @if($permit->state == 'rejected')
                        <label class="badge badge-danger text-capitalize">{{$permit->state}}</label>
                        @elseif($permit->state == 'waitting')
                        <label class="badge badge-info text-capitalize">{{$permit->state}}</label>
                        @else
                        <label class="badge badge-success text-capitalize">{{$permit->state}}</label>
                        @endif
                    </td>
                    <td class="text-capitalize col-1">{{$permit->company}}</td>
                    <td class="text-capitalize col-1">{{$permit->vehicle_clr}}</td>
                    <td class="text-capitalize col-1">

                        @can('Permit Show')
                        <a href="{{route('permits.show',$permit->id)}}" class="btn btn-info"><i
                                class="fas fa-eye"></i></a>
                        @endcan
                        @can('Permit Delete')
                        <a href="{{route('permits.approve',$permit->id)}}" class="btn btn-success"><i
                                class="fas fa-check-circle"></i></a>
                        @endcan
                        @can('Permit Delete')
                        <a href="{{route('permits.refuse',$permit->id)}}" class="btn btn-danger"><i
                                class="fas fa-times-circle"></i></a>
                        @endcan
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
