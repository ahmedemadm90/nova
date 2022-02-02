@extends('layouts.app')
@section('title')
{{__('All Cameras')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
@include('layouts.sessions')
<div class="row">
    <div class="col-md-6">
        <a class="btn btn-success text-capitalize col-md-3" href="{{route('camera.create')}}">{{__('new camera')}}</a>
    </div>
    <div class="col-md-6">
        <form action="{{route('findcams')}}" class="row form form-inline" method="post">
            @csrf
            <div class="col-md-8 m-auto">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInputGrid" name="keywords"
                        placeholder="keywords">
                    <label for="floatingInputGrid" class="fs-5">{{__('keywords')}}</label>
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success fs-5" id="dashboardjson">{{__('Search')}}</button>
            </div>
        </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="container overflow-scroll">
        <table class="table table-hover text-capitalize text-center">
            <thead>
                <tr>
                    <th>{{__('Code')}}</th>
                    <th>{{__('region')}}</th>
                    <th>{{__('Location')}}</th>
                    <th>{{__('area')}}</th>
                    <th>{{__('en name')}}</th>
                    <th>{{__('ar name')}}</th>
                    <th>{{__('operation state')}}</th>
                    <th>{{__('IP')}}</th>
                    <th>{{__('vlan')}}</th>
                    <th>{{__('Record Device')}}</th>
                    <th>{{__('username')}}</th>
                    <th>{{__('password')}}</th>
                    <th>{{__('Camera state')}}</th>
                    <th>{{__('Ticket')}}</th>
                    <th>{{__('maitainance_by')}}</th>
                    <th>{{__('cleaned_by')}}</th>
                    <th>{{__('type')}}</th>
                    <th>{{__('Switch')}}</th>
                    <th>{{__('Company')}}</th>
                    <th>{{__('year')}}</th>
                    <th>{{__('alarm')}}</th>
                    <th>{{__('tools')}}</th>
                </tr>
            </thead>
            <tbody id="">
                @foreach ($cams as $cam)
                <tr>
                    <td class="text-capitalize">{{$cam->code}}</td>
                    <td class="text-capitalize">{{$cam->region}}</td>
                    <td class="text-capitalize">{{$cam->location}}</td>
                    <td class="text-capitalize">{{$cam->area}}</td>
                    <td class="text-capitalize">{{$cam->en_name}}</td>
                    <td class="text-capitalize">{{$cam->ar_name}}</td>
                    <td class="text-capitalize">{{$cam->is_operation}}</td>
                    <td class="text-capitalize">{{$cam->ip}}</td>
                    <td class="text-capitalize">{{$cam->vlan->name}}</td>
                    <td class="text-capitalize">{{$cam->dvr->name}}</td>
                    <td class="">{{$cam->username}}</td>
                    <td class="">{{$cam->password}}</td>
                    <td class="text-capitalize">
                        @if ($cam->state == 'online')
                        <span class="badge bg-success text-capitalize">online</span>
                        @else
                        <span class="badge bg-danger text-capitalize">offline</span>
                        @endif</td>
                    <td class="text-capitalize">{{$cam->ticket}}</td>
                    <td class="text-capitalize">{{$cam->maintenance}}</td>
                    <td class="text-capitalize">{{$cam->clean}}</td>
                    <td class="text-capitalize">{{$cam->type}}</td>
                    <td class="text-capitalize">{{$cam->dispatch->name}}</td>
                    <td class="text-capitalize">{{$cam->company}}</td>
                    <td class="text-capitalize">{{$cam->year}}</td>
                    <td class="text-capitalize">
                        @if ($cam->has_alarm==1)
                        <span class="badge bg-success">{{__('Enabled')}}</span>
                        @else
                        <span class="badge bg-info">{{__('Disabled')}}</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown text-center">
                            <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                                @can('Camera Show')
                                <li><a href="{{route('camera.show',$cam->id)}}" class="dropdown-item"
                                        target="_blank">{{__('Show')}}</a>
                                </li>
                                @endcan
                                @can('Camera Edit')
                                <li><a href="{{route('camera.edit',$cam->id)}}" class="dropdown-item">{{__('Edit')}}</a>
                                </li>
                                @endcan
                                @can('Camera Delete')
                                <li><a href="{{route('camera.destroy',$cam->id)}}"
                                        class="dropdown-item">{{__('Delete')}}</a></li>
                                @endcan

                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
