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
    <div class="col-md border-right mb-2">
        <form class="form-floating text-center col-md-12 m-auto text-capitalize" action="{{route('supplier.storeemp')}}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @include('layouts.errors')
            <div class="row m-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="worker name"
                            name="ar_name" value = {{old('ar_name')}}>
                        <label for="floatingInput">{{__('الاسم عربي')}}</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="worker name"
                            name="en_name" value = {{old('en_name')}}>
                        <label for="floatingInput">{{__('الاسم انجليزي')}}</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating col-md m-auto">
                        <input type="number" class="form-control" id="floatingInput" placeholder="national ID"
                            name="job" value = {{old('job')}}>
                        <label for="floatingInput">{{__('الوظيفة')}}</label>
                    </div>
                </div>
            </div>
            <div class="row m-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="رقم البطاقة"
                            name="nid" value = {{old('nid')}}>
                        <label for="floatingInput">{{__('رقم البطاقة')}}</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="worker name"
                            name="phone1" value = {{old('phone1')}}>
                        <label for="floatingInput">{{__(' 1 رقم التليفون')}}</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="worker name"
                            name="phone2" value = {{old('phone2')}}>
                        <label for="floatingInput">{{__(' 2 رقم التليفون')}}</label>
                    </div>
                </div>
            </div>
            <div class="row m-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="floatingInput" placeholder="company"
                            name="birthdate" value = {{old('birthdate')}}>
                        <label for="floatingInput">{{__('تاريخ الميلاد')}}</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="gender">
                            <option selected hidden disabled>النوع</option>
                            <option value="ذكر">ذكر</option>
                            <option value="انثى">انثى</option>
                        </select>
                        <label for="floatingSelect">النوع</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="company"
                            name="company" value = {{old('company')}}>
                        <label for="floatingInput">{{__('الشركة')}}</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="worker name"
                            name="address" value = {{old('address')}}>
                        <label for="floatingInput">{{__('العنوان')}}</label>
                    </div>
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
    $(document).on('change', '#job', function(){
if ($('#job').val()!= 'labor'){
$('#licence_level').removeAttr("hidden");
} else{
  $('#licence_level').attr('hidden', 'show');
}
});
</script>
@endsection
