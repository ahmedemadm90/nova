<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <img src="{{asset('assets/images/logo.png')}}" height="48" class='mb-4'>
                            </div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="assets/js/app.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
