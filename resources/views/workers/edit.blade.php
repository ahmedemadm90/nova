@extends('layouts.app')
@section('title')
Edit Worker
@endsection
@section('page-title')
Edit Worker || <span class="text-danger">{{$worker->name}}</span>
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title-desc')
Change <span class="text-danger">{{$worker->name}}</span> Details
@endsection
@section('content')
<hr class="w-100 bg-dark">
<div class="row m-2">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('workers.index') }}">Back</a>
        </div>
    </div>
</div>
<div class="container text-capitalize text-center" style="font-family: sans-serif">
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="row">
        <form class="row m-auto text-center" action="{{route('worker.update',$worker->id)}}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row m-auto p-1">
                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        <input type="number" class="form-control" name="id" placeholder="hr or national id"
                            value="{{$worker->id}}">
                        <label for="floatingInputGrid">iD number</label>
                    </div>
                </div>
                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="name" placeholder="name"
                            value="{{$worker->name}}">
                        <label for="floatingInputGrid">name</label>
                    </div>
                </div>
                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="job" placeholder="job" value="{{$worker->position}}">
                        <label for="floatingInputGrid">job</label>
                    </div>
                </div>
                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        <select name="title_id" id="title_id" class="form-select text-capitalize">
                            @foreach ($titles as $title)
                            <option value="{{$title->id}}" @if ($worker->title == $title->title_name)
                                selected
                                @endif>{{$title->title_name}}</option>
                            @endforeach
                        </select>
                        <label for="floatingInputGrid">title</label>
                    </div>
                </div>
            </div>

            <div class="row m-auto p-1">
                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        <select name="vp_id" id="vp" class="form-select text-capitalize">
                            @foreach ($vps as $vp)
                            <option value="{{$vp->id}}" @if ($worker->vp->id == $vp->id)
                                selected
                                @endif>{{$vp->vp_name}}</option>
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
                        <select class="form-select text-capitalize" name="type_id">
                            <option value="" hidden selected>worker type</option>
                            @foreach ($types as $type)
                            <option value="{{$type->id}}" @if ($worker->type_id == $type->id)
                                selected
                                @endif>{{$type->type_name}}</option>
                            @endforeach
                        </select>
                        <label for="floatingInputGrid">worker type</label>
                    </div>
                </div>
                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        <input class="form-control text-capitalize" name="company" id="company"
                            placeholder="worker company" value="{{$worker->company->company_name}}">
                        <label for="floatingInputGrid">worker company</label>
                    </div>
                </div>
            </div>
            <div class="row m-auto p-1">
                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        {{-- <input type="number" class="form-control text-capitalize" name="inv_id"
                            placeholder="Involvoed Person id"> --}}
                        <select class="form-select text-capitalize" name="state">
                            <option class="" hidden selected>{{$worker->state}}</option>
                            <option class='' value="allowed">allowed</option>
                            <option class='' value="suspended">suspended</option>
                            <option class='' value="blacklisted">blacklisted</option>
                        </select>
                        <label for="floatingInputGrid">worker state</label>
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                    <input class="form-control" type="file" name="img" accept=".jpg, .png, .jpeg, .gif|image/*">
                </div>
                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        <select name="emp_man" class="form-select text-capitalize">
                            <option value="" selected hidden>choose manager</option>
                            @foreach ($admins as $admin)
                            <option value="{{$admin->id}}" @if ($worker->worker_manager_id == $admin->id)
                                selected
                                @endif>{{$admin->name}} || {{$admin->title}}</option>
                            @endforeach
                        </select>
                        <label for="floatingInputGrid">worker Manager</label>
                    </div>
                </div>
                @can('Worker Edit')

                <div class="col-md-3 m-auto">
                    <div class="form-floating">
                        <button type="submit" class="btn btn-success text-capitalize">
                            <i class="fas fa-user-edit m-1"></i>
                            Update worker
                        </button>
                    </div>
                </div>
                @endcan

            </div>
        </form>
    </div>
    <hr class="w-100 text-bolder">
    <div class="row m-auto text-center">
        <div class="row m-auto p-1">
            <table class="w-50 m-auto">
                <h3 class="text-center text-bold text-decoration-underline">worker info card</h3>
                <tr>
                    <td class="col-md-3 border p-2">
                        <img src='{{asset("media/$worker->img")}}' width="200" height="200">
                    </td>
                    <td class="col-md-3 border p-2 text-md-left">
                        <p class="text-capitalize text-bold">worker iD : </p>
                        <p class="text-capitalize text-bold">worker name :</p>
                        <p class="text-capitalize text-bold">worker vP :</p>
                        <p class="text-capitalize text-bold">worker area :</p>
                        <p class="text-capitalize text-bold">worker manager :</p>
                    </td>
                    <td class="border text-md-left p-3">
                        <p class="text-capitalize text-bold">{{$worker->id}}</p>
                        <p class="text-capitalize text-bold">{{$worker->name}}</p>
                        <p class="text-capitalize text-bold">{{$worker->vp->vp_name}}</p>
                        <p class="text-capitalize text-bold">{{$worker->area->area_name}}</p>
                        <p class="text-capitalize text-bold">{{$worker->worker_manager->name}}</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on('change', '#vp', function() {
            $('#area').removeAttr("disabled");
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

    });

</script>

@endsection
