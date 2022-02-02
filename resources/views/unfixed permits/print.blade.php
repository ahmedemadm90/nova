@extends('layouts.app')
@section('title')
{{__('All Unfixed Services Workers Data')}}
@endsection
@section('page-title')
{{__('All Unfixed Services Workers Data')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="">
@can('User Create')
<div class="row">
    <div class="col-lg-12 m-2">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('unfixed.emp.create') }}"> {{__('Create New Worker')}}</a>
        </div>
    </div>
</div>
@endcan
@include('layouts.sessions')
<table class="table table-hover m-auto text-center text-capitalize">
    <tr>
        <th>#</th>
        <th>{{__('Worker EN Name')}}</th>
        <th>{{__('Worker Ar Name')}}</th>
        <th>{{__('Job')}}</th>
        <th>{{__('Licence')}}</th>
        <th>{{__('State')}}</th>
        <th>{{__('Permit Company')}}</th>
        <th>{{__('Blacklist')}}</th>
        <th>{{__('Actions')}}</th>
    </tr>
    @foreach ($unfixedEmps as $emp)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $emp->en_name }}</td>
        <td>{{ $emp->ar_name }}</td>
        <td>{{ $emp->job }}</td>
        <td>{{ $emp->licence_level }}</td>
        <td>@if ($emp->active == 0)
            <span class="badge bg-info">{{__('Not Available For Now')}}</span>
            @elseif ($emp->active == 1)
            <span class="badge bg-success">{{__('Available For Hire')}}</span>
            @endif
        </td>
        <td>@if (isset($emp->company_id))
            {{ $emp->company->company_name }}
            @else
            <span class="badge bg-orange">{{__('No Active Permit')}}</span>
            @endif
        </td>
        <td>
            @if ($emp->blacklist == 1)
            <span class="badge bg-danger">{{__('blacklisted')}}</span>
            @else
            <span class="badge bg-success">{{__('Allowed')}}</span>
            @endif
        <td>
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Unfixed Service Emp Show')
                    <li><a class="dropdown-item" href="{{ route('unfixed.emp.edit',$emp->id) }}">Show</a></li>
                    @endcan
                    @can('Unfixed Service Emp Edit')
                    <li><a class="dropdown-item" href="{{ route('unfixed.emp.edit',$emp->id) }}">Edit</a></li>
                    @endcan
                    @can('Unfixed Service Emp Delete')
                    <li><a class="dropdown-item" href="{{ route('unfixed.emp.destroy',$emp->id) }}">Remove</a></li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-center m-2">
    {{ $unfixedEmps->links() }}
</div>
@endsection
