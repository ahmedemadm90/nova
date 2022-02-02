@extends('layouts.app')
@section('title')
{{__('New Unfixed Worker')}}
@endsection
@section('header')
@include('layouts.header')
@endsection
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('page-title')
{{__('New Unfixed Worker')}}
@endsection
@section('page-title-desc')
<hr class="w-100 bg-dark">
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('unfixed.emps.index') }}"> {{__('Back')}}</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md border-right mb-2">

        <form class="form-floating text-center col-md-8 m-auto text-capitalize" action="{{route('unfixed.emp.store')}}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @include('layouts.errors')
            <div class="row m-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="worker name"
                            name="name">
                        <label for="floatingInput">{{__('Worker Name')}}</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating col-md m-auto">
                        <input type="number" class="form-control" id="floatingInput" placeholder="national ID"
                            name="nid">
                        <label for="floatingInput">{{__('National ID')}}</label>
                    </div>
                </div>
            </div>
            <div class="row m-2">
                <div class="col-md">
                    <div class="form-floating">
                        {{-- <input type="number" class="form-control" id="floatingInput" placeholder="Job" name="job"> --}}
                        <select name="job" id="job" class="form-select text-capitalize">
                            <option disabled hidden selected>{{__('select worker job')}}</option>
                            <option value="driver">{{__('driver')}}</option>
                            <option value="labor">{{__('labor')}}</option>
                        </select>
                        <label for="floatingInput">{{__('Job')}}</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating col-md m-auto">
                        <input type="number" class="form-control" id="floatingInput" placeholder="mobile" name="mobile">
                        <label for="floatingInput">{{__('Phone Number')}}</label>
                    </div>
                </div>
            </div>
            <div class="row m-2" id="licence_level" hidden>
                <div class="col-md">
                    <div class="form-floating">
                        <select name="licence_level" id="" class="form-select text-capitalize">
                            <option disabled hidden selected>{{__('select driver licence')}}</option>
                            <option value="اولى">{{__('1st')}}</option>
                            <option value="ثانية">{{__('2nd')}}</option>
                            <option value="ثالثة">{{__('3rd')}}</option>
                            <option value="خاصة">{{__('Private')}}</option>
                        </select>
                        <label for="floatingInput">{{__('Job')}}</label>
                    </div>
                </div>
            </div>

            <div class="row m-2">
                <div class="col-md">
                    <div class="form-floating col-md m-auto">
                        <input type="text" class="form-control" id="floatingInput" placeholder="mobile" name="address">
                        <label for="floatingInput">{{__('address')}}</label>
                    </div>
                </div>
            </div>
            <div class="row m-2">
                <div class="m-auto">
                    <label for="img" class="btn btn-primary">{{__('image')}}</label>
                    <input class="form-control" type="file" style="display: none" name="image">
                </div>
            </div>
            <div class="row m-2">
                <button class="btn btn-success text-capitalize col-md-3 m-auto">{{__('Submit')}}</button>
            </div>
        </form>
    </div>
</div>

@endsection
@section('scripts')
<script>
    $(document).on('change', '#job', function() {
if ($('#job').val() != 'labor') {
$('#licence_level').removeAttr("hidden");
} else{
  $('#licence_level').attr('hidden', 'show');
}
});
</script>
@endsection
