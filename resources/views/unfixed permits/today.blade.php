@extends('layouts.app')
@section('title')
{{__('Permits Ending Today')}}
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('page-title')
{{__('Permits Expiring Today')}}
@endsection
@section('content')
<div class="row">
    <div class="col border-left">
        <table class="table table-hover text-center m-auto text-capitalize">
            <thead>
                <tr class="row">
                    <th class="col-md">{{__('Workers IDs')}}</th>
                    <th class="col-md">{{__('Workers Names')}}</th>
                    <th class="col-md">{{__('Company')}}</th>
                    <th class="col-md">{{__('Pemit End Date')}}</th>
                    <th class="col-md">{{__('Actions')}}</th>
                </tr>
            </thead>
            <tbody id="">
                @foreach ($unfixed_permits as $permit)
                <tr class="row">
                    <td class="text-capitalize col-2">
                        @foreach ($permit->workers_ids as $id)
                        {{$id}}<br>
                        @endforeach
                    </td>
                    <td class="text-capitalize col-2">
                        @foreach ($permit->workers_names as $name)
                        {{$name}}<br>
                        @endforeach
                    </td>
                    <td class="text-capitalize col-2">
                        {{$permit->company}}
                    </td>
                    <td class="text-capitalize col-2">
                        {{$permit->end_date}}
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
        <div class="p-2 text text-decoration-none text-center">
            {{$unfixed_permits->links()}}
        </div>
    </div>
</div>
@endsection
