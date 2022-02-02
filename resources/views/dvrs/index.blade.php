@extends('layouts.app')
@section('title')
{{__('All DVRS')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
@include('layouts.sessions')
<a class="btn btn-success" href="{{route('dvr.create')}}">{{__('New DVR')}}</a>
<div class="row">
    <div class="">
        <table class="table table-hover text-center">
            <thead>
                <tr class="text-capitalize">
                    <th>{{__('Name')}}</th>
                    <th>{{__('Type')}}</th>
                    <th>{{__('Brand')}}</th>
                    <th>{{__('IP')}}</th>
                    <th>{{__('Username')}}</th>
                    <th>{{__('Password')}}</th>
                    <th>{{__('Available')}}</th>
                    <th>{{__('sate')}}</th>
                    <th>{{__('Tools')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dvrs as $dvr)
                <tr>
                    <td class="">{{$dvr->name}}</td>
                    <td class="">{{$dvr->type}}</td>
                    <td class="">{{$dvr->brand}}</td>
                    <td class="">{{$dvr->ip}}</td>
                    <td class="">{{$dvr->username}}</td>
                    <td class="">{{$dvr->password}}</td>
                    <td class="">{{$dvr->available_chs($dvr->id)}}</td>
                    <td class="">
                        @if ($dvr->active==0)
                        <span class="badge bg-danger text-capitalize">{{__('disabled')}}</span>
                        @else
                        <span class="badge bg-success text-capitalize">{{__('active')}}</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown text-center">
                            <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                                @can('DVR Show')
                                <li><a href="{{route('dvr.show',$dvr->id)}}" class="dropdown-item"
                                        target="_blank">{{__('Show')}}</a>
                                </li>
                                @endcan
                                @can('DVR Edit')
                                <li><a href="{{route('dvr.edit',$dvr->id)}}" class="dropdown-item">{{__('Edit')}}</a>
                                </li>
                                @endcan
                                @can('DVR Delete')
                                <li><a href="{{route('dvr.destroy',$dvr->id)}}"
                                        class="dropdown-item">{{__('Delete')}}</a>
                                </li>
                                @endcan

                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center m-2">
        {{ $dvrs->links() }}
    </div>
</div>

@endsection
