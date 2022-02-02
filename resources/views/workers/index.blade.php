@extends('layouts.app')
@section('title')
{{__('All Workers')}}
@endsection
@section('page-title')
{{__('All Workers In Plant')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr class="w-100 bg-dark">
@can('Worker Create')
<div class="row">
    <div class="col-lg-12 m-2">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('worker.create') }}"> {{__('Create New Worker')}}</a>
        </div>
    </div>
</div>
@endcan
<div class="row">
    <div class="col border-left">
        <table class="table table-hover text-center m-auto w-100 text-capitalize">
            <thead>
                <tr>
                    <th>{{__('worker id')}}</th>
                    <th>{{__('image')}}</th>
                    <th>{{__('name')}}</th>
                    <th>{{__('title')}}</th>
                    <th>{{__('vp')}}</th>
                    <th>{{__('area')}}</th>
                    <th>{{__('manager')}}</th>
                    <th>{{__('actions')}}</th>
                </tr>
            </thead>
            <tbody id="">
                @foreach ($workers as $worker)
                <tr>
                    <td class="text-capitalize">{{$worker->id}}</td>
                    <td class="text-capitalize">
                        @if (isset($worker->img))
                        <img src='{{asset("media/workers/$worker->img")}}' class="" width="50" height="50">
                        @else
                        <img src='{{asset("assets/images/temp.png")}}' class="" width="50" height="50">
                        @endif
                    </td>
                    <td class="text-capitalize">{{$worker->name}}</td>
                    <td class="text-capitalize">{{$worker->title->title_name}}</td>
                    <td class="text-capitalize">{{$worker->vp->vp_name}}</td>
                    <td class="text-capitalize">{{$worker->area->area_name}}</td>
                    <td class="text-capitalize">
                        @if(isset($worker->worker_manager))
                        {{$worker->worker_manager->name}}
                        @else
                        <span class="badge bg-info">{{__('No Manager Yet')}}</span>
                        @endif
                    </td>

                    <td>
                        <div class="dropdown text-center">
                            <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                                @can('Worker Show')
                                <li><a class="dropdown-item" href="{{ route('worker.show',$worker->id) }}">Show</a></li>
                                @endcan
                                @can('Worker Edit')
                                <li><a class="dropdown-item" href="{{ route('worker.edit',$worker->id) }}">Edit</a></li>
                                @endcan
                                @can('Worker Delete')
                                <li><a class="dropdown-item" href="{{ route('worker.destroy',$worker->id) }}">Remove</a>
                                </li>
                                @endcan
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center m-2">
            {{ $workers->links() }}
        </div>
    </div>
</div>

@endsection
