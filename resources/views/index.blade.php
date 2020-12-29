<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="7760 Shop">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>7760 Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/font-awesome.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/elegant-icons.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/jquery-ui.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/magnific-popup.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/owl.carousel.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/slicknav.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/alertify.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/themes/bootstrap.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/style.css")}}" type="text/css">
</head>

<body>
    @include('container.header')
    @yield('page')
    @include('container.footer')

</body>
<!-- Js Plugins -->
<script src="{{asset("js/jquery-3.3.1.min.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>
<script src="{{asset("js/jquery.magnific-popup.min.js")}}"></script>
<script src="{{asset("js/jquery-ui.min.js")}}"></script>
<script src="{{asset("js/mixitup.min.js")}}"></script>
<script src="{{asset("js/jquery.countdown.min.js")}}"></script>
<script src="{{asset("js/jquery.slicknav.js")}}"></script>
<script src="{{asset("js/owl.carousel.min.js")}}"></script>
<script src="{{asset("js/jquery.nicescroll.min.js")}}"></script>
<script src="{{asset("js/alertify.min.js")}}"></script>
<script src="{{asset("js/main.js")}}"></script>
@yield('js')
</html>
