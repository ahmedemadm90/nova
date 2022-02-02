@extends('layouts.app')
@section('title')
{{__('New Service Company')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
{{__('New Service Company')}}
@endsection
@section('page-title-desc')
<hr class="w-100 bg-dark">
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('service.companies.index') }}"> {{__('Back')}}</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md border-right mb-2">

        <form class="form-floating text-center col-md-8 m-auto" action="{{route('service.company.store')}}"
            method="POST">
            @csrf

            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control" id="floatingInput" placeholder="Service Company Name"
                    name="company_name">
                <label for="floatingInput">{{__('Company Name')}}</label>
            </div>
            <div class="form-floating m-3 w-auto">
                <input type="text" class="form-control" id="floatingInput" placeholder="Service Company Name"
                    name="owner">
                <label for="floatingInput">{{__('Company Owner Name')}}</label>
            </div>
            <div class="row text-center">
                <div class="form-check form-switch col-md-3 mb-4 m-auto">
                    <input class="form-check-input btn-lg" type="checkbox" id="flexSwitchCheckChecked" value="1"
                        name="active">
                    <label class="form-check-label fs-3" for="flexSwitchCheckChecked">{{__('Active')}}</label>
                </div>
            </div>
            <button class="btn btn-success text-capitalize">{{__('Add')}}</button>
        </form>
    </div>
</div>

@endsection
