@extends('layouts.app')
@section('title')
    {{ __('New UAE Violation') }}
@endsection
@section('page-title')
    {{ __('New UAE Violation') }}
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <hr class="w-100 bg-dark">

    <div class="container text-capitalize text-center" style="font-family: sans-serif">
        <h3 class="text-center ">{{ __('violation information') }}</h3>
        @include('layouts.errors')
        <form class="row m-auto text-center" action="{{ route('uae.violations.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row m-auto p-1">
                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        <select class="form-select text-capitalize" name="type" id="type">
                            <option class='text-capitalize' hidden selected>{{ __('Choose violation type') }}</option>
                            <option class='text-capitalize' value='unsafe-act'>{{ __('unsafe act') }}</option>
                            <option class='text-capitalize' value='unsafe-condition'>{{ __('unsafe condition') }}</option>
                            <option class='text-capitalize' value='unsecure-act'>{{ __('unsecure act') }}</option>
                            <option class='text-capitalize' value='unsecure-condition'>{{ __('unsecure condition') }}
                            </option>
                        </select>
                        <label for="floatingInputGrid">{{ __('violation category') }}</label>
                    </div>
                </div>
                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        <select name="vp_id" id="vp" class="form-select text-capitalize">
                            <option value="" selected hidden>{{ __('select violation Area') }}</option>
                            @foreach ($vps as $vp)
                                <option value="{{ $vp->id }}">{{ $vp->vp_name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingInputGrid">{{ __('Choose violation Area') }}</label>
                    </div>
                </div>
                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        <select name="area_id" id="area" class="form-select text-capitalize" disabled>
                            <option selected hidden class="text-capitalize">{{ __('choose area') }}</option>
                        </select>
                        <label for="floatingInputGrid">{{ __('Choose violation Area') }}</label>
                    </div>
                </div>

            </div>

            <div class="row m-auto p-1">
                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="floatingInputGrid" name="date"
                            placeholder="violation Date" value=" {{ old('date') }}">
                        <label for="floatingInputGrid">{{ __('violation date') }}</label>
                    </div>
                </div>
                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        <input type="time" class="form-control text-capitalize" name="time" placeholder="time"
                            value="{{ old('time') }}">
                        <label for="floatingInputGrid">{{ __('violation time') }}</label>
                    </div>
                </div>

                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        <select class="form-select text-capitalize" name="classification"
                            placeholder="violation classification">
                            <option disabled selected hidden>{{ __('Select Classification') }}</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->classification }}</option>
                            @endforeach
                        </select>
                        <label for="floatingInputGrid">{{ __('violation classification') }}</label>
                    </div>
                </div>
            </div>
            <div id="involvedWorkers">
                <div class="row" id="involved">
                    <div class="col-md" id="selectWorker">
                        <div class="form-floating">
                            <div class="form-floating m-3 w-auto">
                                <select class="form-select text-capitalize" name="involved_id[]">
                                    <option class="text-capitalize" selected hidden disabled>{{ __('Involved Data') }}
                                    </option>
                                    <optgroup label="Indirect">
                                        @foreach ($workers as $worker)
                                            <option class="text-capitalize" value="{{ $worker->id }}">
                                                {{ $worker->id }} ||
                                                {{ $worker->name }} || {{ $worker->company->company_name }}
                                            </option>
                                    </optgroup>
                                    @endforeach
                                </select>
                                <label for="floatingInput">{{ __('Involved') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-auto m-auto m-2">
                        <button class="text-capitalize btn btn-danger" id="removeWorker"><i
                                class="fas fa-user-times"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <button class="text-capitalize btn btn-secondary" id="addWorker"><i class="fas fa-plus-circle"></i></button>
            </div>
            <div id="outsourceInfo" class="m-2">
                <div class="row m-2" id="outsource">
                    <div class="col-md m-auto">
                        <div class="form-floating">
                            <input type="text" name="outsource_ids[]" class="form-control text-capitalize"
                                placeholder="Driver">
                            <label class="text-capitalize">{{ __('outsource id') }}</label>
                        </div>
                    </div>
                    <div class="col-md m-auto">
                        <div class="form-floating">
                            <input type="text" name="outsource_names[]" class="form-control text-capitalize"
                                placeholder="Driver">
                            <label class="text-capitalize">{{ __('outsource name') }}</label>
                        </div>
                    </div>
                    <div class="col-md-auto m-auto m-2">
                        <button class="text-capitalize btn btn-danger" id="removeOutsource">
                            <i class="fas fa-user-times"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <button class="text-capitalize btn btn-secondary" id="addOutsource">
                    <i class="fas fa-plus-circle"></i></button>
            </div>
            <hr class="dropdown-divider bg-dark p-1 w-100">
            <h3 class="text-center m-3 w-100">{{ __('violation details') }}</h3>
            <!--  -->
            <div class="form-group col-md-5 m-auto">
                <textarea class="form-control w-100 text-capitalize" rows="6" style="resize: none;"
                    placeholder="description" name="description">{{ old('discription') }}</textarea>
            </div>
            <div class="form-group col-md-5 m-auto">
                <textarea class="form-control w-100 text-capitalize" rows="6" style="resize: none;"
                    placeholder="action taken" name="action">{{ old('action') }}</textarea>
            </div>

            <hr class="dropdown-divider bg-dark p-1 w-100">
            <h3 class="text-center m-3 w-100">{{ __('violation media') }}</h3>
            <div class="col-md-6 m-auto">
                <label>{{ __('image') }}</label>
                <input class="form-control" type="file" name="gallery[]" accept=".jpg, .png, .jpeg, .gif|image/*"
                    multiple>
            </div>
            <div class="col-md-6">
                <label for="video">{{ __('video') }}</label>
                <input id="video" class="form-control" type="file" name="video" accept=".mp4, .flv|videos/*">
            </div>
            <hr class="dropdown-divider bg-dark p-1 w-100">
            <button type="submit" class="btn btn-success text-capitalize m-auto w-75 mt-3">{{ __('Submit') }}</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('change', '#vp', function() {
                /* $('#area').innerHTML = ''; */
                $('#area').find('option')
                    .remove();
                var vp_id = $(this).val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('findvpareas') }}",
                    data: {
                        "id": vp_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#area').removeAttr("disabled");
                        var selectArea = '';
                        data.forEach(function(row) {
                            var area = $('#area');
                            $('#area').find('option')
                                .remove();
                            selectArea += '<Option value=' + row.id + '>' + row
                                .area_name + '</Option>';
                            $('#area').append(selectArea);
                        });
                        console.log(data.length);
                    },
                    error: function() {

                    },
                });
                $('#area').append();
            });
        });
        $(document).on('click', '#addOutsource', function(event) {
            event.preventDefault();
            $driver = $('#outsource').clone(true).appendTo($('#outsourceInfo'));
        });
        $(document).on('click', '#removeOutsource', function(event) {
            event.preventDefault();
            console.log();
            if ($('#outsourceInfo').children().length < 2) {
                $('#errDriver').fadeIn();
            } else {
                $('#removeOutsource').parent().parent().remove();
            };
            if ($('#errDriver').is(':visible')) {
                setTimeout(function() {
                    $('#errDriver').fadeOut();
                }, 5000);
            };
        });
        $(document).on('click', '#addWorker', function(event) {
            event.preventDefault();
            $involved = $('#involved').clone(true).appendTo($('#involvedWorkers'));
        });
        $(document).on('click', '#removeWorker', function(event) {
            event.preventDefault();
            if ($('#involvedWorkers').children().length < 2) {
                $('#errDriver').fadeIn();
            } else {
                $('#removeWorker').parent().parent().remove();
            };
            if ($('#errDriver').is(':visible')) {
                setTimeout(function() {
                    $('#errDriver').fadeOut();
                }, 5000);
            };
        });
    </script>

@endsection
