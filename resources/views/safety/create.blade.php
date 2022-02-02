@extends('layouts.app')
@section('title')
{{__('New Violation')}}
@endsection
@section('page-title')
{{__('New Violation')}}
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
    <form class="row m-auto text-center" action="{{route('violations.store')}}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row m-auto p-1">
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="number" class="form-control" id="code" name="code" placeholder="violation code"
                        value="{{old('code')}}">
                    <label for="floatingInputGrid">{{__('violation code')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select name="vp_id" id="vp" class="form-select text-capitalize">
                        <option value="" selected hidden>{{__('select violation vP')}}</option>
                        @foreach ($vps as $vp)
                        <option value="{{$vp->id}}">{{$vp->vp_name}}</option>
                        @endforeach
                    </select>
                    <label for="floatingInputGrid">{{__('Choose violation VP')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select name="area_id" id="area" class="form-select text-capitalize" disabled>
                        <option selected hidden class="text-capitalize">{{__('choose area')}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('Choose violation Area')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInputGrid" name="location"
                        placeholder="violation location" style="font-family: sans-serif" value="{{old('location')}}">
                    <label for="floatingInputGrid">{{__('violation Location')}}</label>
                </div>
            </div>
        </div>
        <div class="row m-auto p-1">
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="date" class="form-control" id="floatingInputGrid" name="date"
                        placeholder="violation Date" value=" {{old('date')}}">
                    <label for="floatingInputGrid">{{__('violation date')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="time" class="form-control text-capitalize" name="time" placeholder="time"
                        value="{{old('time')}}">
                    <label for="floatingInputGrid">{{__('violation time')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select class="form-select" name="category" id="category">
                        <option class='text-capitalize' hidden selected>{{__('Choose violation category')}}</option>
                        <option class='text-capitalize' value="safety">{{__('Safety')}}</option>
                        <option class='text-capitalize' value="security">{{__('Security')}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('violation category')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select class="form-select text-capitalize" name="type" id="type">
                        <option class='text-capitalize' hidden selected>{{__('Choose violation type')}}</option>
                        <option class='text-capitalize' value='unsafe-act'>{{__('unsafe act')}}</option>
                        <option class='text-capitalize' value='unsafe-condition'>{{__('unsafe condition')}}</option>
                        <option class='text-capitalize' value='security' hidden>{{__('security')}}</option>
                    </select>
                    <label for="floatingInputGrid">{{__('violation category')}}</label>
                </div>
            </div>
        </div>
        <div class="row m-auto p-1">
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="number" class="form-control text-capitalize" name="inv_id"
                        placeholder="Involvoed Person id" value="{{old('inv_id')}}">
                    <label for="floatingInputGrid">{{__('invoved iD')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="text" class="form-control text-capitalize" name="inv_name"
                        placeholder="involved person name" value="{{old('inv_name')}}">
                    <label for="floatingInputGrid">{{__('invoved name')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="text" class="form-control text-capitalize" name="inv_pos"
                        placeholder="involved person position" value="{{old('inv_pos')}}">
                    <label for="floatingInputGrid">{{__('invoved position')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="text" class="form-control text-capitalize" name="inv_company"
                        placeholder="involved person company" value="{{old('inv_company')}}">
                    <label for="floatingInputGrid">{{__('invoved company')}}</label>
                </div>
            </div>
        </div>

        <div class="row m-auto p-1">
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select class="form-select text-capitalize" name="inv_type">
                        <option class="" hidden selected>{{__('involved person type')}}</option>
                        <option class='' value="direct">direct</option>
                        <option class='' value="mp">mP</option>
                        <option class='' value="service">services</option>
                    </select>
                    <label for="floatingInputGrid">{{__('involved type')}}</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    {{-- <input type="text" class="form-control text-capitalize" name="area_res_id"
                        placeholder="area responsible"> --}}
                    <select name="area_res_id" class="form-select text-capitalize">
                        <option value="" selected hidden>{{__('area responsible')}}</option>
                        @foreach ($admins as $admin)
                        <option value="{{$admin->id}}">{{$admin->name}} || {{$admin->title}}</option>
                        @endforeach
                    </select>
                    <label for="floatingInputGrid">{{__('area responsible')}}</label>
                </div>
            </div>

            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="number" class="form-control text-capitalize" name="nearmiss" placeholder="near miss"
                        value="{{old('nearmiss')}}">
                    <label for="floatingInputGrid">{{__('near miss')}}</label>
                </div>
            </div>
        </div>
        <br>
        <hr class="dropdown-divider bg-dark p-1 w-100">
        <h3 class="text-center m-3 w-100">{{__('violation details')}}</h3>
        <!--  -->
        <div class="form-group col-md-6">
            <textarea class="form-control w-100 text-capitalize" rows="6" style="resize: none;"
                placeholder="description" name="description">{{old('discription')}}</textarea>
        </div>
        <div class="form-group col-md-6">
            <textarea class="form-control w-100 text-capitalize" rows="6" style="resize: none;" placeholder="actions"
                name="action">{{old('action')}}</textarea>
        </div>
        <hr class="dropdown-divider bg-dark p-1 w-100">
        <h3 class="text-center m-3 w-100">{{__('violation media')}}</h3>
        <div class="col-md-6">
            <label>{{__('image')}}</label>
            <input class="form-control" type="file" name="img" accept=".jpg, .png, .jpeg, .gif|image/*">
        </div>
        <div class="col-md-6">
            <label>{{__('video')}}</label>
            <input class="form-control" type="file" name="vid" accept=".mp4, .flv|videos/*">
        </div>
        <hr class="dropdown-divider bg-dark p-1 w-100">
        <button type="submit" class="btn btn-success text-capitalize m-auto w-75 mt-3">{{__('Submit')}}</button>
    </form>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#type').attr('disabled', 'disabled');
        $(document).on('change', '#vp', function() {
            /* $('#area').innerHTML = ''; */
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
        $(document).on('change', '#category', function() {
            if ($('#category').val() != 'security') {
                $('#type').removeAttr("disabled");
                $('#type').val('unsafe-act');
            } else {
                $('#type').attr('disabled', 'disabled');
                $('#type').val('security');
            }
        });

    });

</script>

@endsection
