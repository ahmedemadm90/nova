@extends('layouts.app')
@section('title')
{{__('Edit UAE Violation')}} || {{$violation->id}}
@endsection
@section('page-title')
{{__('Edit UAE Violation')}} || {{$violation->id}}
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
    <h3 class="text-center ">{{__('violation information')}}</h3>
    @include('layouts.errors')
    <form class="row m-auto text-center" action="{{route('uae.violation.update',$violation->id)}}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row m-auto p-1">
        <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select class="form-select text-capitalize" name="type" id="type">
                        <option class='text-capitalize' hidden selected>{{$violation->type}}</option>
                        <option class='text-capitalize' value='unsafe act'>{{__('unsafe act')}}</option>
                        <option class='text-capitalize' value='unsafe condition'>{{__('unsafe condition')}}</option>
                        <option class='text-capitalize' value='unsecure act'>{{__('unsecure act')}}</option>
                        <option class='text-capitalize' value='unsecure condition'>{{__('unsecure condition')}}
                        </option>
                    </select>
                    <label for="floatingInputGrid">{{__('violation category')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select name="vp_id" id="vp" class="form-select text-capitalize">
                        <option value="{{$violation->vp_id}}" selected hidden>{{$violation->vp->vp_name}}</option>
                        @foreach ($vps as $vp)
                        <option value="{{$vp->id}}">{{$vp->vp_name}}</option>
                        @endforeach
                    </select>
                    <label for="floatingInputGrid">{{__('Choose violation VP')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select name="area_id" id="area" class="form-select text-capitalize">
                        <option value="{{$violation->area_id}}" selected hidden class="text-capitalize">
                            {{$violation->area->area_name}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('Choose violation Area')}}</label>
                </div>
            </div>
            
        </div>

        <div class="row m-auto p-1">
        <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="date" class="form-control" id="floatingInputGrid" name="date"
                        placeholder="violation Date" value="{{$violation->date}}">
                    <label for="floatingInputGrid">{{__('violation date')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="time" class="form-control text-capitalize" name="time" placeholder="time"
                        value="{{$violation->time}}">
                    <label for="floatingInputGrid">{{__('violation time')}}</label>
                </div>
            </div>
            
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select class="form-select text-capitalize" name="classification"
                        placeholder="violation classification">
                        <option selected hidden value="{{$violation->classification}}">
                            {{$violation->vioType->classification}}</option>
                        @foreach ($types as $type)
                        <option value="{{$type->id}}">{{$type->classification}}</option>
                        @endforeach
                    </select>
                    <label for="floatingInputGrid">{{__('violation classification')}}</label>
                </div>
            </div>
        </div>
        <div id="involvedWorkers">
            @foreach ($insource as $key=>$value)
            <div class="row" id="involved">
                <div class="col-md" id="selectWorker">
                    <div class="form-floating">
                        <div class="form-floating m-3 w-auto">
                            <select class="form-select text-capitalize" name="involved_id[]">
                                <option class="text-capitalize" selected hidden disabled>{{__('Involved Data')}}
                                </option>
                                @foreach ($workers as $worker)
                                <option class="text-capitalize" value="{{$worker->id}}" @if ($worker->id === $key)
                                    selected
                                    @endif>{{$worker->id}} ||
                                    {{$worker->name}} || {{$worker->company->company_name}}
                                </option>
                                @endforeach
                            </select>
                            <label for="floatingInput">{{__('Involved')}}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto m-auto m-2">
                    <button class="text-capitalize btn btn-danger" id="removeWorker">
                        {{__('remove woker')}}</button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-3 m-auto">
            <button class="text-capitalize btn btn-secondary" id="addWorker">
                {{__('add worker')}}</button>
        </div>
        @foreach ($outsource as $key=>$value)
        <div id="outsourceInfo">
            <div class="row m-2" id="outsource">
                <div class="col-md m-auto">
                    <div class="form-floating">
                        <input type="text" name="outsource_ids[]" class="form-control text-capitalize"
                            placeholder="outsource ids" value="{{$key}}">
                        <label class="text-capitalize">{{__('outsource id')}}</label>
                    </div>
                </div>
                <div class="col-md m-auto">
                    <div class="form-floating">
                        <input type="text" name="outsource_names[]" class="form-control text-capitalize"
                            placeholder="outsource_names" value="{{$value}}">
                        <label class="text-capitalize">{{__('outsource name')}}</label>
                    </div>
                </div>
                <div class="col-md-auto m-auto m-2">
                    <button class="text-capitalize btn btn-danger" id="removeOutsource">
                        {{__('remove outsource')}}</button>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-md-3 m-auto">
            <button class="text-capitalize btn btn-secondary" id="addOutsource">
                {{__('add outsource')}}</button>
        </div>
        <hr class="dropdown-divider bg-dark p-1 w-100">
        <h3 class="text-center m-3 w-100">{{__('violation details')}}</h3>
        <!--  -->
        <div class="form-group col-md-5 m-auto">
            <textarea class="form-control w-100 text-capitalize" rows="6" style="resize: none;"
                placeholder="description" name="description">{{$violation->description}}</textarea>
        </div>
        <div class="form-group col-md-5 m-auto">
            <textarea class="form-control w-100 text-capitalize" rows="6" style="resize: none;"
                placeholder="action taken" name="action">{{$violation->action}}</textarea>
        </div>
        <hr class="dropdown-divider bg-dark p-1 w-100">
        <h3 class="text-center m-3 w-100">{{ __('violation media') }}</h3>
        <div class="row">
            <div id="carouselExampleControlsNoTouching" class="carousel slide col-md-6" data-bs-touch="false"
                data-bs-interval="false">
                <div class="carousel-inner shadow-none mt-4">
                    <div class="row">
                        @foreach ($violation->gallery as $img)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src='{{ asset("public/media/violations/uae/images/$img") }}' style="height: 240px"
                                class="w-75">
                        </div>
                        @endforeach
                    </div>
                    <button class="btn btn-secondary m-3" type="button"
                        data-bs-target="#carouselExampleControlsNoTouching"
                        data-bs-slide="prev">{{ __('Previous') }}</button>
                    <button class="btn btn-primary m-3" type="button"
                        data-bs-target="#carouselExampleControlsNoTouching"
                        data-bs-slide="next">{{ __('Next') }}</button>
                    <div class="">
                        <label for="gallery" class="btn btn-success">{{ __('update image') }}</label>
                        <input id="gallery" class="form-control" type="file" name="gallery[]"
                            accept=".jpg, .png, .jpeg, .gif|image/*" multiple hidden>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label>{{ __('Video') }}</label><br>
                <video class="w-100" src='{{ asset("public/media/violations/uae/video/$violation->video") }}'" controls
                            style=" height: 250px"></video>
                <label for=" video" class="btn btn-primary">{{ __('update Video') }}</label>
                <input id=" video" class="form-control" type="file" name="video" accept=".mp4, .flv|videos/*" multiple
                    hidden>
            </div>
        </div>
        <hr class="dropdown-divider bg-dark p-1 w-100">
        <button type="submit" class="btn btn-success text-capitalize m-auto w-75 mt-3">{{__('Submit')}}</button>
    </form>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on('change', '#vp', function() {
            $('#area').find('option')
            .remove();
            var vp_id = $(this).val();
            $.ajax({
                type: 'get'
                , url: "{{route('findvpareas')}}"
                , data: {
                    "id": vp_id
                }
                , dataType: 'json'
                , success: function(data) {
                    $('#area').removeAttr("disabled");
                    var selectArea = '';
                    data.forEach(function(row) {
                        var area = $('#area');
                        $('#area').find('option')
                            .remove();
                        selectArea += '<Option value=' + row.id + '>' + row.area_name + '</Option>';
                        $('#area').append(selectArea);
                    });
                    console.log(data.length);
                }
                , error: function() {

                }
            , });
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
    if ($('#outsourceInfo').children().length < 2) { $('#errDriver').fadeIn(); } else {
        $(this).parent().parent().remove();
         };
        if($('#errDriver').is(':visible')){
        setTimeout(function() {
        $('#errDriver').fadeOut();
        }, 5000); };
        });
        $(document).on('click', '#addWorker', function(event) {
    event.preventDefault();
    $involved = $('#involved').clone(true).appendTo($('#involvedWorkers'));
    });
    $(document).on('click', '#removeWorker', function(event) {
    event.preventDefault();
    if ($('#involvedWorkers').children().length < 2) { $('#errDriver').fadeIn();
    } else {
        $('#removeWorker').parent().parent().remove();
         };
        if($('#errDriver').is(':visible')){
        setTimeout(function() {
        $('#errDriver').fadeOut();
        }, 5000); };
        });


</script>

@endsection
