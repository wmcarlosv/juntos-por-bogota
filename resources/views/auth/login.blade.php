@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('css')
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css?v=1') }}" />
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <img src="img/auth_logo.png" class="logo" />
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label>CÉDULA DE CIUDADANÍA:</label>
                            <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ old('dni') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Contraseña:</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                <div class="input-group-prepend">
                                    <button type="button" id="show_password" data-view="1" class="btn btn-success"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                            
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="fom-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    Recordarme
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    Entrar
                                </button>  
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        ¿Olvidades tu Contraseña?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $("#show_password").click(function(){
                let view = $(this).attr("data-view");
                if(view == '1'){
                    $("#password").attr("type","text");
                    $(this).attr("data-view",0);
                    $(this).html("<i class='fas fa-eye-slash'></i>");
                }else{
                    $(this).attr("data-view",1);
                    $(this).html("<i class='fas fa-eye'></i>");
                    $("#password").attr("type","password");
                }
            });
        });
    </script>
@stop
