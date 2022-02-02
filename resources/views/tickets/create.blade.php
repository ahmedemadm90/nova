@extends('layouts.app')
@section('title')
{{__('New Maintenance Ticket')}}
@endsection
@section('page-title')
{{__('New Maintenance Ticket')}}
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
    @include('layouts.errors')
    <form class="row m-auto text-center" action="{{route('ticket.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        @foreach ($cams as $cam)
                        <option class="text-capitalize" value="{{$cam->code}}">{{$cam->code}} || {{$cam->en_name}} ||
                            {{$cam->ar_name}}
                        </option>
                        @endforeach
                    </select>
                    <label for="floatingSelect">{{__('Camera')}}</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        @foreach ($cams as $cam)
                        <option class="text-capitalize" value="{{$cam->code}}">{{$cam->code}} || {{$cam->en_name}} ||
                            {{$cam->ar_name}}
                        </option>
                        @endforeach
                    </select>
                    <label for="floatingSelect">{{__('Camera')}}</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" name="state">
                        <option class="text-capitalize"></option>
                    </select>
                    <label for="floatingSelect">{{__('Camera')}}</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success text-capitalize m-auto w-25 mt-3">{{__('Submit')}}</button>
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
