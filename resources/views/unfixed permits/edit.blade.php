@extends('layouts.app')
@section('title')
{{__('Edit Unfixed Permit')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
{{__('Edit Unfixed Service Workers Permit')}}
@endsection
@section('content')
<hr class="w-100 bg-dark">
<div class="container text-capitalize text-center" style="font-family: sans-serif">
    @include('layouts.errors')
    <div class="row">
        <div class="alert alert-danger text-center" id="errDriver">
            {{__('Permit Must Have At Least One Worker')}}
        </div>
        <div class="alert alert-danger text-center" id="dateerr">
            {{__('Please Select Correct Dates To Procced')}}
        </div>
        <form class="row m-auto text-center" action="{{route('unfixed.permit.update',$permit->id)}}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div id="permitInfo">
                @foreach ($data as $key=>$value)
                <div class="row m-2" id="driver">
                    <div class="col-md m-auto">
                        <div class="form-floating">
                            <input type="text" class="form-control text-capitalize" placeholder="Driver"
                                value="{{$value}}" disabled>
                            <label class="text-capitalize">{{__('Worker Name')}}</label>
                        </div>
                    </div>
                    <div class="col-md m-auto">
                        <div class="form-floating">
                            <input type="text" class="form-control text-capitalize" placeholder="Driver"
                                value="{{$key}}" disabled>
                            <label class="text-capitalize">{{__('Worker iD')}}</label>
                        </div>
                    </div>
                    <div class="col-md-auto m-auto m-2">
                        <button class="text-capitalize btn btn-danger" id="removeDriver">
                            {{__('remove worker')}}</button>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-3 m-auto">
                <button class="text-capitalize btn btn-secondary" id="addDriver">
                    {{__('add worker')}}</button>
            </div>
            <div class="row m-2">
                <div class="col-md m-auto">
                    <div class="form-floating">
                        <input type="date" id="datefrm" name="start_date" class="form-control text-capitalize"
                            placeholder="From" value="{{$permit->start_date}}">
                        <label class="text-capitalize">{{__('start date')}}</label>
                    </div>
                </div>
                <div class="col-md m-auto">
                    <div class="form-floating">
                        <input type="date" id="dateto" name="end_date" class="form-control text-capitalize"
                            placeholder="From" value="{{$permit->end_date}}">
                        <label class="text-capitalize">{{__('end date')}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 m-auto">
                    <div class="form-floating">
                        <input type="text" name="company" class="form-control text-capitalize" placeholder="Driver"
                            value="{{$permit->company}}">
                        <label class="text-capitalize">{{__('company')}}</label>
                    </div>
                </div>
            </div>
            <hr class=" w-100 m-auto mb-2 mt-2">
            <div class="col-md-6 m-auto mb-2">
                <button type="submit" class="btn btn-success w-100 m-3">{{__('Submit')}}</button>
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
            if($('#datefrm').val() > $('#dateto').val()){
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
