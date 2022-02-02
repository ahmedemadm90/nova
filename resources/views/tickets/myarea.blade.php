@extends('layouts.app')
@section('title')
{{__('All Vilations In My Area')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('page-title')
{{__('Vilations In My Area')}}
@endsection
@section('page-title-desc')
{{__('Vilations In My Area Orderd ByDate')}}
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="w-100 bg-dark">
<div class="row">
    <table class="table table-hover  text-capitalize text-center">
        <thead>
            <tr>
                <th>{{__('code')}}</th>
                <th>{{__('vp')}}</th>
                <th>{{__('area')}}</th>
                <th>{{__('Location')}}</th>
                <th>{{__('time')}}</th>
                <th>{{__('Type')}}</th>
                <th>{{__('Tools')}}</th>
            </tr>
        </thead>
        <tbody id="">
            @foreach ($violations as $violation)
            <tr>
                <td class="text-capitalize">{{$violation->code}}</td>
                <td class="text-capitalize">{{$violation->vp->vp_name}}</td>
                <td class="text-capitalize">{{$violation->area->area_name}}</td>
                <td class="text-capitalize">{{$violation->location}}</td>
                <td class="text-capitalize">{{$violation->date}}</td>
                <td class="text-capitalize">{{$violation->type}}</td>
                <td>
                    <div class="dropdown text-center">
                        <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                            @can('Violation Show')
                            <li><a href="{{route('violations.show',$violation->code)}}" class="dropdown-item"
                                    target="_blank">{{__('Show')}}</a>
                            </li>
                            @endcan
                            @can('Violation Edit')
                            <li><a href="{{route('violations.edit',$violation->code)}}"
                                    class="dropdown-item">{{__('Edit')}}</a>
                            </li>
                            @endcan
                            @can('Violation Delete')
                            <li><a href="{{route('violations.destroy',$violation->code)}}"
                                    class="dropdown-item">{{__('Delete')}}</a></li>
                            @endcan

                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-2 text text-decoration-none text-center">

    </div>
</div>

@endsection
