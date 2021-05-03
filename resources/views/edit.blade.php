@extends('layouts.app')

@section('title','Editar Amigo')

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
       <h2>editar referido</h2>
       <div class="card-body">
            <form autocomplete="off" method="POST" action="{{ route('update_friend',$friend->id) }}">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" name="name" value="{{ $friend->name }}" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Apellido:</label>
                            <input type="text" name="last_name" value="{{ $friend->last_name }}" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>dni:</label>
                            <input type="text" name="dni" value="{{ $friend->dni }}" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>fecha de nacimiento:</label>
                            <input type="date" name="birth_date" value="{{ $friend->birth_date }}" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Correo electrónico:</label>
                            <input type="text" name="email" value="{{ $friend->email }}" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Numero de Telefono:</label>
                            <input type="text" name="phone" value="{{ $friend->phone }}" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Dirección:</label>
                    <textarea class="form-control" name="address">{{ $friend->address }}</textarea>
                </div>
                <div class="form-group text-center" style="padding-top: 20px;">
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                </div>
            </form>
       </div>
   </div>
</div>
@endsection
