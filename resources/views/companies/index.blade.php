@extends('layouts.app')
@section('title')
{{__('All Companies')}}
@endsection
@section('page-title')
{{__('All Companies')}}
@endsection
@section('page-title-desc')
{{__('Manage Companies In The Plant')}}
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
            <a class="btn btn-success" href="{{ route('company.create') }}"> {{__('Create New Company')}}</a>
        </div>
    </div>
</div>
@endcan
@if ($message = Session::get('success'))
<div class="alert alert-success m-2">
    <p>{{ $message }}</p>
</div>
@elseif($message = Session::get('error'))
<div class="alert alert-success m-2">
    <p>{{ $message }}</p>
</div>
@endif
<table class="table table-hover m-auto text-center text-capitalize">
    <tr>
        <th>#</th>
        <th>{{__('Company Name')}}</th>
        <th>{{__('Employees Count')}}</th>
        <th>{{__('Actions')}}</th>
    </tr>
    @foreach ($companies as $company)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $company->company_name }}</td>
        <td>{{App\Models\Worker::where('company_id',$company->id)->count()}}</td>
        <td>
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Company Show')
                    <li><a class="dropdown-item" href="{{ route('company.show',$company->id) }}">Show</a></li>
                    @endcan
                    @can('Company Edit')
                    <li><a class="dropdown-item" href="{{ route('company.edit',$company->id) }}">Edit</a></li>
                    @endcan
                    @can('Company Delete')
                    <li><a class="dropdown-item" href="{{ route('company.destroy',$company->id) }}">Remove</a></li>
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
