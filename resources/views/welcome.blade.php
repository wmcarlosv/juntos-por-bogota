<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Juntos por Bogotá</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}?v=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" />
</head>
<body>
<div class="container-fluid">
    <div class="row" id="nav_bar">
        <div class="col-md-6 col-sm-4 col-2">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/nav_bar_logo.png') }}" />
            </a>
        </div>
        <div class="col-md-6 col-sm-8 col-10 text-right" id="column-two-nav-bar">
            <a href="{{ route('login') }}" id="login">iniciar sesión</a>
            <a href="{{ route('register') }}" id="register">registrarse</a>
        </div>  
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <img id="center-logo" src="{{ asset('img/center_logo.png') }}">
        </div>
    </div>
</div>
    <img id="footer-logo" src="{{ asset('img/footer_logo.png') }}" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>