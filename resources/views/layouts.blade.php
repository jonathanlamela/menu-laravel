<html>
<head>
    <title>@yield('title') - Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">


    <link href="/css/app.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column flex-grow-1" style="background-color:#f8f9fa">
    <div class="container-md p-0 d-flex flex-column flex-grow-1">
        <div class="shadow bg-white d-flex flex-column flex-grow-1">
            <div class="col-lg-12 d-flex flex-column flex-grow-1">
                @section('topbar')
                @show
                @section('header')
                @show
                @section('nav')
                @show
                @section('content')
                @show
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
