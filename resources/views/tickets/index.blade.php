@extends('layouts.app')
@section('title')
{{__('All Maintenance Tickets')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<a class="btn btn-success text-capitalize" href="{{route('ticket.create')}}">{{__('New Ticket')}}</a>
<div class="row">
    <table class="table table-hover  text-capitalize text-center">
        <thead>
            <tr>
                <th>{{__('#')}}</th>
                <th>{{__('Device Code')}}</th>
                <th>{{__('Issue Date')}}</th>
                <th>{{__('Ticket Details')}}</th>
                <th>{{__('Closing Date')}}</th>
                <th>{{__('state')}}</th>
                <th>{{__('Tools')}}</th>
            </tr>
        </thead>
        <tbody id="">
            @foreach ($tickets as $ticket)
            <tr>
                <td class="text-capitalize">{{$ticket->id}}</td>
                <td class="text-capitalize">{{$ticket->vp->vp_name}}</td>
                <td class="text-capitalize">{{$ticket->area->area_name}}</td>
                <td class="text-capitalize">{{$ticket->location}}</td>
                <td class="text-capitalize">{{$ticket->date}}</td>
                <td class="text-capitalize">{{$ticket->type}}</td>
                <td>
                    <div class="dropdown text-center">
                        <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                            @can('Violation Show')
                            <li><a href="{{route('tickets.show',$ticket->id)}}" class="dropdown-item"
                                    target="_blank">{{__('Show')}}</a>
                            </li>
                            @endcan
                            @can('Violation Edit')
                            <li><a href="{{route('tickets.edit',$ticket->id)}}" class="dropdown-item">{{__('Edit')}}</a>
                            </li>
                            @endcan
                            @can('Violation Delete')
                            <li><a href="{{route('tickets.destroy',$ticket->id)}}"
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
        {{ $tickets->links() }}
    </div>
</div>

@endsection
