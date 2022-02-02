<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.svg')}}" type="image/x-icon">
    <script src="{{asset('assets/jquery/jquery.min.js')}}"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="app">
        @yield('sidebar')
        <div id="main">
            @yield('header')
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>@yield('page-title')</h3>
                    <p class="text-subtitle text-muted">@yield('page-title-desc')</p>
                </div>
                <section class="section">
                    @yield('cards')
                    @yield('content')
                </section>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script src="{{asset('assets/js/chart.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('js/jQuery.print.js')}}"></script>
    @yield('scripts')
</body>

</html>
