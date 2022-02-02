@extends('layouts.app')
@section('title')
    {{ __('All Unfixed Permits') }}
@endsection
@section('page-title')
    {{ __('All Unfixed Permits') }}
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 m-2">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('unfixed.permit.create') }}"> {{ __('Create New Permit') }}</a>
            </div>
        </div>
    </div>
    <hr class="w-100 bg-dark">
    <div class="row">
        <div class="col border-left">
            <table class="table table-hover text-center m-auto text-capitalize">
                <thead>
                    <tr class="row">
                        <th class="col-md">{{ __('Workers IDs') }}</th>
                        <th class="col-md-3">{{ __('Workers Names') }}</th>
                        <th class="col-md">{{ __('Company') }}</th>
                        <th class="col-md">{{ __('Pemit End Date') }}</th>
                        <th class="col-md">{{ __('Requested By') }}</th>
                        <th class="col-md">{{ __('State') }}</th>
                    </tr>
                </thead>
                <tbody id="" class="text-center">
                    @foreach ($unfixed_permits as $permit)
                        <tr class="row">
                            <td class="text-capitalize col-md">
                                @foreach ($permit->workers_ids as $id)
                                    {{ $id }}<br>
                                @endforeach
                            </td>
                            <td class="text-capitalize col-md-3">
                                @foreach ($permit->workers_names as $name)
                                    {{ $name }}<br>
                                @endforeach
                            </td>
                            <td class="text-capitalize col-md">
                                {{ $permit->company->company_name }}
                            </td>
                            <td class="text-capitalize col-md">
                                {{ $permit->end_date }}
                            </td>
                            <td class="text-capitalize col-md">
                                {{ $permit->user->name }}
                            </td>
                            <td class="text-capitalize col-md">
                                {{ $permit->state }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center m-2">
                {{ $unfixed_permits->links() }}
            </div>
        </div>
    </div>
@endsection
