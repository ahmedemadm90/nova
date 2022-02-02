@extends('layouts.app')
@section('title')
    {{ __('Permit Detalis') }}
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <table class="table table-condensed text-center m-auto w-100 text-capitalize">
                <thead>
                    <tr class="row">
                        <th class="col-md">start date</th>
                        <th class="col-md">end date</th>
                        <th class="col-md-4">drivers Details</th>
                        <th class="col-md">drivers IDs</th>

                        <th class="col-md">State</th>
                    </tr>
                </thead>
                <tbody id="">
                    <tr class="row">
                        <td class="text-capitalize col-md">
                            <label class="badge bg-success">{{ $permit->start_date }}</label>
                        </td>
                        <td class="text-capitalize col-md">
                            <label class="badge bg-danger">{{ $permit->end_date }}</label>
                        </td>
                        <td class="text-capitalize col-md-4">
                            @foreach ($permit->workers_names as $worker)
                                {{ $worker }}<br>
                            @endforeach
                        </td>
                        <td class="text-capitalize col-md">
                            @foreach ($permit->workers_ids as $id)
                                {{ $id }}<br>
                            @endforeach
                        </td>
                        <td class="text-capitalize col-md">
                            <span class="badge bg-info">{{ $permit->state }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
