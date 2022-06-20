<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    @yield('title')
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="{{ asset('Home/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Home/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Home/css/responsive.css') }}">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="{{ asset('Home/css/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Home/css/owl.carousel.min.css') }}">
    <link rel="stylesoeet" href="{{ asset('Home/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    @yield('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <div class="banner_bg_main">
        @include('partials.home.header');
        @include('partials.home.banner');
    </div>
    @yield('content');
    @include('partials.home.footer')


    <script src="{{ asset('Home/js/jquery.min.js') }}"></script>
    <script src="{{ asset('Home/js/popper.min.js') }}"></script>
    <script src="{{ asset('Home/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Home/js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('Home/js/plugin.js') }}"></script>
    <script src="{{ asset('Home/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('Home/js/custom.js') }}"></script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
    @yield('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
