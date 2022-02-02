@extends('layouts.app')
@section('title')
{{__('Manage Haulers')}}
@endsection
@section('page-title')
{{__('Manage Haulers')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<hr>
@can('Hauler Create')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right m-2">
            <a class="btn btn-success" href="{{ route('hauler.create') }}"> {{__('New Hauler')}}</a>
        </div>
    </div>
</div>
@endcan
@include('layouts.sessions')
<table class="table table-hover w-75 m-auto text-center text-capitalize">
    <tr>
        <th>#</th>
        <th>{{__('Hauler')}}</th>
        <th>{{__('State')}}</th>
        <th>{{__('Trucks Included')}}</th>
        <th>{{__('change state')}}</th>
        <th class="text-center">{{__('Action')}}</th>
    </tr>
    @foreach ($haulers as $hauler)
    <tr>
        <td>{{ ++$i }}</td>
        <td class="text-capitalize">{{ $hauler->name }}</td>
        <td class="text-capitalize">
            @if ($hauler->active == 1)
            <span class="badge bg-success">Active</span>
            @else
            <span class="badge bg-danger">Disabled</span>
            @endif
        </td>
        <td class="text-capitalize">{{ $hauler->trucks($hauler->id) }}</td>
        <td class="text-capitalize">
            @if ($hauler->active == 1)
            <a href="{{route('hauler.changestate',$hauler->id)}}" class="btn btn-danger">Disable</a>
            @else
            <a href="{{route('hauler.changestate',$hauler->id)}}" class="btn btn-success">enable</a>
            @endif</td>
        <td>
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton1">
                    @can('Hauler Edit')
                    <li><a class="dropdown-item" href="{{ route('hauler.edit',$hauler->id) }}">Edit</a></li>
                    @endcan
                    @can('Hauler Delete')
                    <li><a class="dropdown-item" href="{{ route('hauler.destroy',$hauler->id) }}">Remove</a></li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
</table>

<div class="d-flex justify-content-center m-2">
    {{ $haulers->links() }}
</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on('change', '#state', function() {
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

</script>
@endsection
