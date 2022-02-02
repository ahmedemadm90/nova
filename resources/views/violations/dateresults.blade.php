@extends('layouts.app')
@section('title')
{{__('Vilations')}} || {{__('From ')}} {{$date_from}} {{__('To ')}}{{$date_to}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('page-title')
{{__('Violations')}} || {{__('From ')}} {{$date_from}} {{__('To ')}}{{$date_to}}
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<div class="row">
    <a class="btn btn-primary col-md-1" href="{{route('violations.index')}}">{{__('Back')}}</a>
    <form action="{{route('violations.exportdate')}}" class="col-md-3">
        <input value="{{$date_from}}" name="date_from" hidden>
        <input value="{{$date_to}}" name="date_to" hidden>
        <button class="btn btn-success" href="">{{__('Export')}}</button>
    </form>
</div>
<hr class="w-100 bg-dark">
@include('layouts.sessions')
<div class="row">
    <table class="table table-hover  text-capitalize text-center" id="vios">
        <thead>
            <tr>
                <th class="col-md-1">{{__('#')}}</th>
                <th class="col-md-1">{{__('Type')}}</th>
                <th class="col-md-1">{{__('Area')}}</th>
                <th class="col-md-1">{{__('Location')}}</th>
                <th class="col-md-1">{{__('Date')}}</th>
                <th class="col-md-1">{{__('time')}}</th>
                <th class="col-md-1">{{__('Images')}}</th>
                <th class="col-md-1">{{__('Tools')}}</th>
            </tr>
        </thead>
        <tbody id="">
            @foreach ($vios as $violation)
            <tr>
                <td class="text-capitalize">{{$violation->id}}</td>
                <td class="text-capitalize">{{$violation->category}}</td>
                <td class="text-capitalize">{{$violation->vp->vp_name}}</td>
                <td class="text-capitalize">{{$violation->area->area_name}}</td>
                <td class="text-capitalize">{{$violation->date}}</td>
                <td class="text-capitalize">{{$violation->time}}</td>
                <td class="text-capitalize">
                    <div id="carouselExampleControls" class="carousel slide shadow-none" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach( $violation->gallery as $img )
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="height: 100px">
                                <img class="d-block img-fluid" src='{{asset("media/violations/egy/images/$img")}}'
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
                            <li><a href="{{route('uae.violations.show',$violation->id)}}" class="dropdown-item"
                                    target="_blank">{{__('Show')}}</a>
                            </li>
                            @endcan
                            @can('Violation Edit')
                            <li><a href="{{route('uae.violations.edit',$violation->id)}}" class="dropdown-item"
                                    target="_blank">{{__('Edit')}}</a>
                            </li>
                            @endcan
                            @can('Violation Delete')
                            <li><a href="{{route('uae.violations.destroy',$violation->id)}}"
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
    <div class="p-2 text text-decoration-none text-center">
        {{$vios->render()}}
    </div>
</div>

@endsection
{{-- @section('scripts')
<script>
    $(document).on('click', '#print', function() {
        $("#vios").print();
    });

</script>
@endsection --}}
