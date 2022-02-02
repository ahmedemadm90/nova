@extends('layouts.app')
@section('title')
{{__('Permits Needs Safety Approval')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('page-title')
{{__('Permits Needs Safety Approval')}}
@endsection
@section('page-title-desc')
{{__('Permits Needs Safety Approval')}}
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="w-100 bg-dark">
<div class="row">
    <table class="table table-hover text-center m-auto w-100 text-capitalize">
            <thead>
                <tr class="row text-center">
                    <th class="col-md">permit type</th>
                    <th class="col-md">start date</th>
                    <th class="col-md">end date</th>
                    <th class="col-md">Drivers</th>
                    <th class="col-md">Color</th>
                    <th class="col-md">Requested By</th>
                    @can('Approve Group Permits')
                    <th class="col-md">actions</th>
                    @elsecan('Reject Group Permits')
                        <th class="col-md">actions</th>
                    @endcan
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
                    <td class="text-capitalize col-md">
                        @foreach ($permit->vehicle_drivers_id as $nid)
                        <label class="">{{$permit->driver($nid)->ar_name}}</label>
                        @endforeach
                    </td>

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
                                @can('Approve Group Permits')
                                <li><form action="{{route('safety.permits.service.reject',$permit->id)}}" method="post">
                                    @csrf
                                    <button class="dropdown-item">Reject</button>
                                </form></li>
                                {{-- <a href="{{route('permit.refuse',$permit->id)}}" class="dropdown-item"></a> --}}
                                @endcan
                                @can('Approve Group Permits')
                                <li><form action="{{route('safety.permits.service.approve',$permit->id)}}" method="post">
                                    @csrf
                                    <button class="dropdown-item">Approve</button>
                                </form></li>
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

@endsection
