@extends('layouts.app')
@section('title')
{{__('All Service Companies')}}
@endsection
@section('page-title')
{{__('All Service Companies')}}
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
            <a class="btn btn-success" href="{{ route('service.company.create') }}">
                {{__('Create New Service Company')}}</a>
        </div>
    </div>
</div>
@endcan
@include('layouts.sessions')
<table class="table table-hover m-auto text-center text-capitalize">
    <tr>
        <th>#</th>
        <th>{{__('Service Company Name')}}</th>
        <th>{{__('Active Permits')}}</th>
        <th>{{__('State')}}</th>
        <th>{{__('Actions')}}</th>
    </tr>
    @foreach ($companies as $company)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $company->company_name }}</td>
        <td>{{App\Models\UnfixedPermit::where('company_id',$company->id)->where('active',1)->count()}}</td>
        <td>
            @if ($company->active == 1)
            <span class="badge bg-success">{{__('Active')}}</span>
            @else
            <span class="badge bg-danger">{{__('Disabled')}}</span>
            @endif
        </td>
        <td>
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Service Company Show')
                    <li><a class="dropdown-item" href="{{ route('service.company.show',$company->id) }}">Show</a></li>
                    @endcan
                    @can('Service Company Edit')
                    <li><a class="dropdown-item" href="{{ route('service.company.edit',$company->id) }}">Edit</a></li>
                    @endcan
                    @can('Service Company Delete')
                    <li><a class="dropdown-item" href="{{ route('service.company.destroy',$company->id) }}">Remove</a>
                    </li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
</table>

<div class="d-flex justify-content-center m-2">
    {{ $companies->links() }}
</div>
@endsection
