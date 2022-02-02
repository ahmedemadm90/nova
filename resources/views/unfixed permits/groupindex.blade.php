@extends('layouts.app')
@section('title')
    {{ __('Pending Group Permits') }}
@endsection
@section('page-title')
    {{ __('Pending Group Permits') }}
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    @can('Unfixed Permit Create')
        <div class="row">
            <div class="col-lg-12 m-2">
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('unfixed.permit.create') }}"> {{ __('Create New Permit') }}</a>
                </div>
            </div>
        </div>
        <hr class="w-100 bg-dark">
    @endcan

    <div class="row">
        <div class="col border-left">
            <table class="table table-hover text-center m-auto text-capitalize">
                <thead>
                    <tr class="row">
                        <th class="col-md">{{ __('Workers IDs') }}</th>
                        <th class="col-md-4">{{ __('Workers Names') }}</th>
                        <th class="col-md">{{ __('Company') }}</th>
                        <th class="col-md">{{ __('Pemit End Date') }}</th>
                        <th class="col-md">{{ __('Requested By') }}</th>
                        <th class="col-md">{{ __('Actions') }}</th>
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
                            <td class="text-capitalize col-md-4">
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
                            <td class="col-md">
                                <div class="dropdown text-center">
                                    <button class="btn" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                                        @can('Unfixed Permits Manage')
                                            <li>
                                                <form action="{{ route('unfixed.group.permit.approve', $permit->id) }}"
                                                    method="post">@csrf<button
                                                        class="dropdown-item">{{ __('Approve') }}</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('unfixed.group.permit.reject', $permit->id) }}"
                                                    method="post">@csrf<button
                                                        class="dropdown-item">{{ __('Reject') }}</button>
                                                </form>
                                            </li>
                                        @endcan
                                        @can('Unfixed Permit Show')
                                            <li><a class="dropdown-item"
                                                    href="{{ route('unfixed.permit.show', $permit->id) }}">{{ __('Show') }}</a>
                                            </li>
                                        @endcan
                                        @can('Unfixed Permit Edit')
                                            <li><a class="dropdown-item"
                                                    href="{{ route('unfixed.permit.edit', $permit->id) }}">{{ __('edit') }}</a>
                                            </li>
                                        @endcan

                                        @can('Unfixed Permit Delete')
                                            <li><a class="dropdown-item"
                                                    href="{{ route('unfixed.permit.destroy', $permit->id) }}">{{ __('Delete') }}</a>
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
                {{ $unfixed_permits->links() }}
            </div>
        </div>
    </div>
@endsection
