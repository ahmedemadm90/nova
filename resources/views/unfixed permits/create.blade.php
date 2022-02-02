@extends('layouts.app')
@section('title')
    {{ __('Create Unfixed Permit') }}
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('page-title')
    {{ __('New Unfixed Service Workers Permit') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 m-2">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('unfixed.permits.index') }}"> {{ __('Back') }}</a>
            </div>
        </div>
    </div>
    <hr class="w-100 bg-dark">
    <div class="container text-capitalize text-center" style="font-family: sans-serif">
        @include('layouts.errors')
        <div class="row">
            <div class="alert alert-danger text-center" id="errDriver">
                {{ __('Permit Must Have At Least One Worker') }}
            </div>
            <div class="alert alert-danger text-center" id="dateerr">
                {{ __('Please Select Correct Dates To Procced') }}
            </div>
            <form class="row m-auto text-center" action="{{ route('unfixed.permit.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div id="permitInfo">
                    <div class="row m-2" id="driver">
                        <div class="col-md m-auto">
                            <div class="form-floating">
                                <select name="workers_ids[]" class="form-select text-capitalize" placeholder="Driver">
                                    <option selected disabled hidden>{{ __('worker') }}</option>
                                    @foreach ($unfixed_workers as $worker)
                                        <option value="{{ $worker->nid }}" @if (isset($worker->company_id))
                                            disabled
                                    @endif>{{ $worker->nid }} || {{ $worker->en_name }}
                                    @if (isset($worker->company_id))
                                        || <span class="text-danger">on mission now</span>
                                    @endif
                                    </option>
                                    @endforeach
                                </select>
                                <label class="text-capitalize">{{ __('Worker Name') }}</label>
                            </div>
                        </div>
                        <div class="col-md-auto m-auto m-2">
                            <button class="text-capitalize btn btn-danger" id="removeDriver">
                                {{ __('remove worker') }}</button>
                        </div>

                    </div>
                </div>
                <div class="col-md-3 m-auto">
                    <button class="text-capitalize btn btn-secondary" id="addDriver">
                        {{ __('add worker') }}</button>
                </div>
                <div class="row m-2">
                    <div class="col-md m-auto">
                        <div class="form-floating">
                            <input type="date" id="datefrm" name="start_date" class="form-control text-capitalize"
                                placeholder="From">
                            <label class="text-capitalize">{{ __('start date') }}</label>
                        </div>
                    </div>
                    <div class="col-md m-auto">
                        <div class="form-floating">
                            <input type="date" id="dateto" name="end_date" class="form-control text-capitalize"
                                placeholder="From">
                            <label class="text-capitalize">{{ __('end date') }}</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-md m-auto">
                        <div class="form-floating">
                            <select name="company_id" class="form-select text-capitalize" placeholder="Company">
                                <option disabled hidden selected>{{ __('Choose Company') }}</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                            <label class="text-capitalize">{{ __('company') }}</label>
                        </div>
                    </div>
                    <div class="col-md m-auto">
                        <div class="form-floating">
                            <select name="group_id" id="" class="form-select">
                                <option value="" disabled hidden selected>{{ __('Please Select The Group') }}</option>
                                @if ($groups != null)
                                    @foreach ($groups as $group_id)
                                        <option value="{{ $group_id }}">
                                            {{ Auth::user()->group($group_id)->group_name }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected hidden>Contact Your Admin Please</option>
                                @endif
                            </select>
                            <label class="text-capitalize">{{ __('Permit Group') }}</label>
                        </div>
                    </div>
                </div>
                <hr class=" w-100 m-auto mb-2 mt-2">
                <div class="col-md-6 m-auto mb-2">
                    <button type="submit" class="btn btn-success w-100 m-3">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
        <hr class="w-100 text-bolder">
    </div>
@endsection
@section('scripts')
    <script>
        /* $('#permitInfo')=''; */
        $(document).ready(function() {
            $('#type').attr('disabled', 'disabled');
            $('#errDriver').hide();
            $('#dateerr').hide();

            $(document).on('click', '#addDriver', function(event) {
                event.preventDefault();
                $driver = $('#driver').clone(true).appendTo($('#permitInfo'));
            });
            $(document).on('click', '#removeDriver', function(event) {
                event.preventDefault();
                console.log();
                if ($('#permitInfo').children().length < 2) {
                    $('#errDriver').fadeIn();
                } else {
                    $('#removeDriver').parent().parent().remove();
                    $('#drivers-count').val($('#permitInfo').children().length);
                };
                if ($('#errDriver').is(':visible')) {
                    setTimeout(function() {
                        $('#errDriver').fadeOut();
                    }, 5000);
                };
            });
            $(document).on('change', '#dateto', function() {
                if ($('#datefrm').val() > $('#dateto').val()) {
                    $('#dateerr').show();
                    $('#datefrm').val('');
                    $('#dateto').val('');
                    $('#datefrm').focus();
                }
                if ($('#dateerr').is(':visible')) {
                    setTimeout(function() {
                        $('#dateerr').fadeOut();
                    }, 5000);
                };

            });
        });
    </script>
@endsection
