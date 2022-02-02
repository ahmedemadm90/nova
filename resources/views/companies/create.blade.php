@extends('layouts.app')
@section('title')
{{__('New Company')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
{{__('Create New Company')}}
@endsection
@section('page-title-desc')
<hr class="w-100 bg-dark">
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('companies.index') }}"> {{__('Back')}}</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md border-right mb-2">

        <form class="form-floating text-center col-md-8 m-auto" action="{{route('company.store')}}" method="POST">
            @csrf
            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control" id="floatingInput" placeholder="Vp Name" name="company_name">
                <label for="floatingInput">{{__('Company Name')}}</label>
            </div>
            <button class="btn btn-success text-capitalize">Add</button>
        </form>
    </div>
</div>

@endsection
