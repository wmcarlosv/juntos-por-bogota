<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Juntos por Bogotá - @yield('title','Home')</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layout.css') }}" />
    @yield('css')
</head>
<body>
    <div class="container-fluid">
        <div id="nav_header">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-2">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('img/nav_bar_logo.png') }}" />
                    </a>
                </div>
                <div class="col-lg-10 col-md-10 col-10 text-right column-register">
                    @yield('right-content')
                </div>
            </div>
        </div>
        @yield('content')
        @if(@$users)
            <div class="menu">
                <h1>{{ Auth::user()->name.' '.Auth::user()->last_name }}</h1>
                <hr />
                <ul>
                    <li><a href="{{ route('profile') }}">Editar Perfil</a></li>
                    <li><a href="{{ route('view_password') }}">Cambiar Contraseña</a></li>
                    <li><a href="{{ route('add') }}">Añadir Referido</a></li>
                    <li><a href="{{ route('home') }}">Total referidos <span>{{ @$users->count() }}</span></a></li>
                    @if(Auth::user()->is_admin)
                        <li><a href="{{ route('administrator') }}">Administracion</a></li>
                    @endif
                    <li><a href="#" id="set-logout">Cerrar Sesión</a></li>
                </ul>
                <form method="POST" id="logout" action="{{ route('logout') }}">@csrf</form>
            </div>
        @endif
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@yield('js')
<script type="text/javascript">
    $("#set-logout").click(function(){
        $("#logout").submit();
    });

    $("#burger").click(function(e){
        if(!$(this).attr("data-open")){
            $("div.menu").show();
            $(this).attr("data-open","si");
        }else{
            $("div.menu").hide();
            $(this).removeAttr("data-open");
        }
    });
</script>
</body>
</html>
