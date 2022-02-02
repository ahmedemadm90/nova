@extends('layouts.app')
@section('title')
    Requested Permits State
@endsection
@section('page-title')
    My Requested Permits State
@endsection
@section('page-title-desc')
    Show And Manage My Requested Permits
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
            <table class="table table-hover text-center m-auto text-capitalize">
                <thead>
                    <tr class="row">
                        <th class="col-md">permit type</th>
                        <th class="col-md">start date</th>
                        <th class="col-md">end date</th>
                        <th class="col-md">drivers</th>
                        <th class="col-md">phones</th>
                        <th class="col-md">State</th>
                        @can('Manage Own Permits')
                            <th class="col-md">Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody id="">
                    @foreach ($permits as $permit)
                        <tr class="row">
                            <td class="text-capitalize col-md">{{ $permit->type }}</td>
                            <td class="text-capitalize col-md">
                                <label class="badge bg-success text-capitalize">{{ $permit->date_from }}</label>
                            </td>
                            <td class="text-capitalize col-md">
                                <label class="badge bg-danger text-capitalize">{{ $permit->date_to }}</label>
                            </td>
                            <td class="text-capitalize col-md">
                                @foreach ($permit->vehicle_drivers_id as $id)
                                    {{ $permit->driver($id)->ar_name }}<br>
                                @endforeach
                            </td>
                            <td class="text-capitalize col-md">
                                @foreach ($permit->vehicle_drivers_id as $id)
                                    {{ $permit->driver($id)->phone }}<br>
                                @endforeach
                            </td>
                            <td class="text-capitalize col-md">
                                @if ($permit->state == 'rejected')
                                    <label class="badge bg-danger text-capitalize">{{ $permit->state }}</label>
                                @elseif($permit->state == 'waitting')
                                    <label class="badge bg-info text-capitalize">{{ $permit->state }}</label>
                                @else
                                    <label class="badge badge-success text-capitalize">{{ $permit->state }}</label>
                                @endif
                            </td>
                            @can('Manage Own Permits')
                                <td class="col-md">
                                    <div class="dropdown text-center">
                                        <button class="btn" type="button" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                                            @can('Approve Own Permit')
                                                <li><a class="dropdown-item"
                                                        href="{{ route('permits.approve', $permit->id) }}">Approve</a></li>
                                            @endcan
                                            @can('Reject Own Permit')
                                                <li><a class="dropdown-item"
                                                        href="{{ route('permits.rejecte', $permit->id) }}">Reject</a></li>
                                            @endcan
                                        </ul>
                                    </div>
                                </td>
                            @endcan

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
