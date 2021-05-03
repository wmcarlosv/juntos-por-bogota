@extends('layouts.app')

@section('title','Editar Perfil')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/escritorio.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}" />
@stop

@section('right-content')
<span class="user-name">{{ Auth::user()->name.' '.Auth::user()->last_name }}</span>
<a href="#" id="burger">
    <img src="/img/burger.png" />
</a>
@stop

@section('content')
<div class="container">
   <div class="card">
    <a class="close-add" href="{{ route('home') }}">X</a>   
       <h2>Cambiar Contraseña</h2>
       <div class="card-body">
            <form autocomplete="off" method="POST" action="{{ route('change_password') }}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>Contraseña:</label>
                    <input type="password" name="password" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Confirmar Contraseña:</label>
                    <input type="password" name="password_confirmation" class="form-control" />
                </div>
                <div class="form-group text-center" style="padding-top: 20px;">
                    <button class="btn btn-primary" type="submit">actualizar</button>
                </div>
            </form>
       </div>
   </div>
</div>
@endsection
