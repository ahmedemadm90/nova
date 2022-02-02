@extends('inclodes.master')
@section('title')
New Violation
@endsection
@section('cards')
@include('inclodes.contentheader')
@endsection
@section('header')
@include('inclodes.header')
@endsection
@section('sidebar')
@include('inclodes.sidebar')
@endsection
@section('footer')
@include('inclodes.footer')
@endsection
@section('content')
<hr class="w-100 bg-dark">

<div class="container text-capitalize text-center" style="font-family: sans-serif">
    <h3 class="text-center ">violation information</h3>
    @include('inclodes.errors')
    <form class="row m-auto text-center" action="{{route('violation.store')}}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row m-auto p-1">
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="number" class="form-control" id="code" name="code" placeholder="violation code">
                    <label for="floatingInputGrid">violation code</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select name="vp_id" id="vp" class="form-select text-capitalize">
                        <option value="" selected hidden>select violation vP</option>
                        @foreach ($vps as $vp)
                        <option value="{{$vp->id}}">{{$vp->vp_name}}</option>
                        @endforeach
                    </select>
                    <label for="floatingInputGrid">Choose violation VP</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select name="area_id" id="area" class="form-select text-capitalize" disabled>
                        <option selected hidden class="text-capitalize">choose area</option>
                    </select>
                    <label for="floatingInputGrid">Choose violation Area</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInputGrid" name="location"
                        placeholder="violation location" style="font-family: sans-serif">
                    <label for="floatingInputGrid">violation Location</label>
                </div>
            </div>
        </div>
        <div class="row m-auto p-1">
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="date" class="form-control" id="floatingInputGrid" name="date"
                        placeholder="violation Date">
                    <label for="floatingInputGrid">violation date</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="time" class="form-control text-capitalize" name="time" placeholder="time">
                    <label for="floatingInputGrid">violation time</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select class="form-select" name="category" id="category">
                        <option class='text-capitalize' hidden selected>Choose violation category</option>
                        <option class='text-capitalize' value="safety">safety</option>
                        <option class='text-capitalize' value="security">security</option>
                    </select>
                    <label for="floatingInputGrid">violation category</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select class="form-select text-capitalize" name="type" id="type">
                        <option class='text-capitalize' hidden selected>Choose violation type</option>
                        <option class='text-capitalize' value='unsafe-act'>unsafe act</option>
                        <option class='text-capitalize' value='unsafe-condition'>unsafe condition</option>
                        <option class='text-capitalize' value='security' hidden>security</option>
                    </select>
                    <label for="floatingInputGrid">violation category</label>
                </div>
            </div>
        </div>
        <div class="row m-auto p-1">
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="number" class="form-control text-capitalize" name="inv_id"
                        placeholder="Involvoed Person id">
                    <label for="floatingInputGrid">invoved iD</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="text" class="form-control text-capitalize" name="inv_name"
                        placeholder="involved person name">
                    <label for="floatingInputGrid">invoved name</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="text" class="form-control text-capitalize" name="inv_pos"
                        placeholder="involved person position">
                    <label for="floatingInputGrid">invoved position</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="text" class="form-control text-capitalize" name="inv_company"
                        placeholder="involved person company">
                    <label for="floatingInputGrid">invoved company</label>
                </div>
            </div>
        </div>

        <div class="row m-auto p-1">
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <select class="form-select text-capitalize" name="inv_type">
                        <option class="" hidden selected>involved person type</option>
                        <option class=''>direct</option>
                        <option class=''>mP</option>
                        <option class=''>services</option>
                    </select>
                    <label for="floatingInputGrid">involved type</label>
                </div>
            </div>
            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    {{-- <input type="text" class="form-control text-capitalize" name="area_res_id"
                        placeholder="area responsible"> --}}
                    <select name="area_res_id" id="vp" class="form-select text-capitalize">
                        <option value="" selected hidden>area responsible</option>
                        @foreach ($admins as $admin)
                        <option value="{{$admin->id}}">{{$admin->name}} || {{$admin->title->title_name}}</option>
                        @endforeach
                    </select>
                    <label for="floatingInputGrid">area responsible</label>
                </div>
            </div>

            <div class="col-md-3 m-auto">
                <div class="form-floating">
                    <input type="number" class="form-control text-capitalize" name="nearmiss" placeholder="near miss">
                    <label for="floatingInputGrid">near miss</label>
                </div>
            </div>
        </div>
        <br>
        <hr class="dropdown-divider bg-dark p-1 w-100">
        <h3 class="text-center m-3 w-100">violation details</h3>
        <!--  -->
        <div class="form-group col-md-6">
            <textarea class="form-control w-100 text-capitalize" rows="6" style="resize: none;"
                placeholder="description" name="description"></textarea>
        </div>
        <div class="form-group col-md-6">
            <textarea class="form-control w-100 text-capitalize" rows="6" style="resize: none;" placeholder="actions"
                name="action"></textarea>
        </div>
        <hr class="dropdown-divider bg-dark p-1 w-100">
        <h3 class="text-center m-3 w-100">violation media</h3>
        <div class="col-md-6">
            <label>image</label>
            <input class="form-control" type="file" name="img" accept=".jpg, .png, .jpeg, .gif|image/*">
        </div>
        <div class="col-md-6">
            <label>video</label>
            <input class="form-control" type="file" name="vid" accept=".mp4, .flv|videos/*">
        </div>
        <hr class="dropdown-divider bg-dark p-1 w-100">
        <button name="newvio" type="submit" class="btn btn-success text-capitalize m-auto w-75 mt-3">submit</button>
    </form>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#type').attr('disabled', 'disabled');


        $(document).on('change', '#vp', function() {
            $('#area').innerHTML = "";
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
                        /* var area = $('#area'); */
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
