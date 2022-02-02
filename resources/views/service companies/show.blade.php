@extends('layouts.app')
@section('title')
{{__('Show Company Info')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
{{__('Show Company Info')}} || <span class="text-danger">{{$company->company_name}}</span>
@endsection
@section('content')
<hr class="">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('service.companies.index') }}"> {{__('Back')}}</a>
        </div>
    </div>
</div>
@include('layouts.sessions')
<div class="row">
    <div class="container w-50">
        <div class="col-md border-right mb-2">
            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control" id="floatingInput" placeholder="Service Company Name"
                    name="company_name" value="{{$company->company_name}}" readonly>
                <label for="floatingInput">{{__('Company Name')}}</label>
            </div>
            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control" id="floatingInput" placeholder="Service Company Name"
                    name="owner" value="{{$company->owner}}" readonly>
                <label for="floatingInput">{{__('Company Owner Name')}}</label>
            </div>
            <div class="row text-center">
                <div class="form-check form-switch col-md-3 mb-4 m-auto">
                    <input class="form-check-input btn-lg" type="checkbox" id="flexSwitchCheckChecked" value="1"
                        name="active" @if ($company->active == 1)
                    checked
                    @endif readonly>
                    <label class="form-check-label fs-3" for="flexSwitchCheckChecked">{{__('Active')}}</label>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>{{__('Active Service Permits')}}</h3>
    <table class="table table-hover text-center m-auto text-capitalize">
        <thead>
            <tr class="row">
                <th class="col-md">{{__('Workers IDs')}}</th>
                <th class="col-md-auto">{{__('Workers Names')}}</th>
                <th class="col-md">{{__('Company')}}</th>
                <th class="col-md">{{__('Pemit End Date')}}</th>
                <th class="col-md">{{__('Requested By')}}</th>
                <th class="col-md">{{__('State')}}</th>
                <th class="col-md">{{__('Actions')}}</th>
            </tr>
        </thead>
        <tbody id="" class="text-center">
            @foreach (App\Models\Permit::where('company_id',$company->id)->get() as $permit)
            <tr class="row">
                <td class="text-capitalize col-md">
                    @foreach ($permit->workers_ids as $id)
                    {{$id}}<br>
                    @endforeach
                </td>
                <td class="text-capitalize col-md-auto">
                    @foreach ($permit->workers_names as $name)
                    {{$name}}<br>
                    @endforeach
                </td>
                <td class="text-capitalize col-md">
                    {{$permit->company->company_name}}
                </td>
                <td class="text-capitalize col-md">
                    {{$permit->end_date}}
                </td>
                <td class="text-capitalize col-md">
                    {{$permit->user->name}}
                </td>
                <td class="text-capitalize col-md">
                    @if ($permit->state==0)
                    <span class="badge bg-danger">{{__('Expired')}}</span>
                    @elseif($permit->state == 1)
                    <span class="badge bg-Success">{{__('Active')}}</span>
                    @endif
                </td>
                <td class="col-md">
                    <div class="dropdown text-center">
                        <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                            @can('Unfixed Permit Show')
                            <li><a class="dropdown-item"
                                    href="{{route('unfixed.permit.show',$permit->id)}}">{{__('Show')}}</a></li>
                            @endcan
                            @can('Unfixed Permit Edit')
                            <li><a class="dropdown-item"
                                    href="{{route('unfixed.permit.edit',$permit->id)}}">{{__('edit')}}</a></li>
                            @endcan

                            @can('Unfixed Permit Delete')
                            <li><a class="dropdown-item"
                                    href="{{route('unfixed.permit.destroy',$permit->id)}}">{{__('Delete')}}</a></li>
                            @endcan
                        </ul>
                    </div>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <h3>{{__('Active Unfixed Service Permits')}}</h3>
    <table class="table table-hover text-center m-auto text-capitalize">
        <thead>
            <tr class="row">
                <th class="col-md">{{__('Workers IDs')}}</th>
                <th class="col-md-auto">{{__('Workers Names')}}</th>
                <th class="col-md">{{__('Company')}}</th>
                <th class="col-md">{{__('Pemit End Date')}}</th>
                <th class="col-md">{{__('Requested By')}}</th>
                <th class="col-md">{{__('State')}}</th>
                <th class="col-md">{{__('Actions')}}</th>
            </tr>
        </thead>
        <tbody id="" class="text-center">
            @foreach (App\Models\UnfixedPermit::where('company_id',$company->id)->get() as $permit)
            <tr class="row">
                <td class="text-capitalize col-md">
                    @foreach ($permit->workers_ids as $id)
                    {{$id}}<br>
                    @endforeach
                </td>
                <td class="text-capitalize col-md-auto">
                    @foreach ($permit->workers_names as $name)
                    {{$name}}<br>
                    @endforeach
                </td>
                <td class="text-capitalize col-md">
                    {{$permit->company->company_name}}
                </td>
                <td class="text-capitalize col-md">
                    {{$permit->end_date}}
                </td>
                <td class="text-capitalize col-md">
                    {{$permit->user->name}}
                </td>
                <td class="text-capitalize col-md">
                    @if ($permit->active==0)
                    <span class="badge bg-danger">{{__('Expired')}}</span>
                    @elseif($permit->active == 1)
                    <span class="badge bg-Success">{{__('Active')}}</span>
                    @endif
                </td>
                <td class="col-md">
                    <div class="dropdown text-center">
                        <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                            @can('Unfixed Permit Show')
                            <li><a class="dropdown-item"
                                    href="{{route('unfixed.permit.show',$permit->id)}}">{{__('Show')}}</a></li>
                            @endcan
                            @can('Unfixed Permit Edit')
                            <li><a class="dropdown-item"
                                    href="{{route('unfixed.permit.edit',$permit->id)}}">{{__('edit')}}</a></li>
                            @endcan

                            @can('Unfixed Permit Delete')
                            <li><a class="dropdown-item"
                                    href="{{route('unfixed.permit.destroy',$permit->id)}}">{{__('Delete')}}</a></li>
                            @endcan
                        </ul>
                    </div>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
