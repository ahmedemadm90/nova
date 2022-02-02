@extends('layouts.app')
@section('title')
{{__('All Violations')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
@can('Violation Create')
<a class="btn btn-success mb-2" href="{{route('violations.create')}}">{{__('New Violation')}}</a>
<a id="print" class="btn btn-info mb-2" href="{{route('violations.export')}}">{{__('ُExport All Violations')}}</a>
@endcan
<div class="row">
<div class="col-md-8">
<form action="{{route('violations.search')}}" method="post" class="row">
        @csrf
        <div class="form-floating col-md-4">
            <input class="form-control col-md" name="date_from" placeholder="By Date" type="date">
            <label for="floatingInputGrid">&nbsp;&nbsp;&nbsp;&nbsp;{{__('Date')}}</label>
        </div>
        <div class="form-floating col-md-4">
            <input class="form-control col-md" name="date_to" placeholder="By Date" type="date">
            <label for="floatingInputGrid">&nbsp;&nbsp;&nbsp;&nbsp;{{__('Date')}}</label>
        </div>
        <div class="mt-1 col-md-4">
            <button class="btn btn-info">{{__('Search')}}</button>
        </div>
    </form>
</div>
<div class="col-md-4">
<form action="{{route('violations.nearmiss.search')}}" method="post" class="row">
        @csrf
        <div class="form-floating col-md-8">
            <input class="form-control col-md" name="keyword" placeholder="Search Violation" type="text">
            <label for="floatingInputGrid" class="text-capitalize">&nbsp;&nbsp;&nbsp;&nbsp;{{__('nearmiss')}}</label>
        </div>
        <div class="mt-1 col-md-4">
            <button class="btn btn-info">{{__('Search')}}</button>
        </div>
    </form>
</div>

</div>
<div class="row">
    <table class="table table-hover  text-capitalize text-center">
        <thead>
            <tr>
                <th>{{__('code')}}</th>
                <th>{{__('vp')}}</th>
                <th>{{__('area')}}</th>
                <th>{{__('Location')}}</th>
                <th>{{__('date')}}</th>
                <th>{{__('Type')}}</th>
                <th>{{__('Images')}}</th>
                <th>{{__('Tools')}}</th>
            </tr>
        </thead>
        <tbody id="">
            @foreach ($violations as $violation)
            <tr>
                <td class="text-capitalize">{{$violation->id}}</td>
                <td class="text-capitalize">{{$violation->vp->vp_name}}</td>
                <td class="text-capitalize">{{$violation->area->area_name}}</td>
                <td class="text-capitalize">{{$violation->location}}</td>
                <td class="text-capitalize">{{$violation->date}}</td>
                <td class="text-capitalize">{{$violation->category}}</td>
                <td class="text-capitalize">
                    <div id="carouselExampleControls" class="carousel slide shadow-none" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach( $violation->gallery as $img )
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="height: 100px">
                                <img class="d-block img-fluid" src='{{asset("public/media/violations/egy/images/$img")}}'
                                    style="width: 100%;height:100%">
                            </div>
                            @endforeach
                        </div>

                    </div>

                </td>
                <td>
                    <div class="dropdown text-center">
                        <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                            @can('Violation Show')
                            <li><a href="{{route('violations.show',$violation->id)}}" class="dropdown-item"
                                    target="_blank">{{__('Show')}}</a>
                            </li>
                            @endcan
                            @can('Violation Edit')
                            <li><a href="{{route('violations.edit',$violation->id)}}"
                                    class="dropdown-item">{{__('Edit')}}</a>
                            </li>
                            @endcan
                            @can('Violation Delete')
                            <li><a href="{{route('violations.destroy',$violation->id)}}"
                                    class="dropdown-item">{{__('Delete')}}</a></li>
                            @endcan

                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center m-2">
        {{ $violations->links() }}
    </div>
</div>

@endsection
