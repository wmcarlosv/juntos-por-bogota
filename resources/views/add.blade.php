@extends('layouts.app')

@section('title','Agregar Amigo')

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
       <h2>añadir referido</h2>
       <div class="card-body">
            <form autocomplete="off" method="POST" action="{{ route('add_friend') }}">
                @csrf
                @method('post')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombres:</label>
                            <input type="text" name="name" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Apellidos:</label>
                            <input type="text" name="last_name" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>CÉDULA DE CIUDADANÍA:</label>
                            <input type="text" name="dni" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>fecha de nacimiento:</label>
                            <input type="date" name="birth_date" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sexo:</label>
                            <select class="form-control" name="sex">
                                <option value="male">Masculino</option>
                                <option value="female">Femenino</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Correo electrónico:</label>
                            <input type="text" name="email" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Numero de Telefono:</label>
                            <input type="text" name="phone" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>localidad:</label>
                            <select class="form-control" name="locale">
                                <option value="">Seleccione</option>
                                @foreach($locales as $locale)
                                    <option value="{{ $locale['id'] }}">{{ $locale['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Dirección:</label>
                    <textarea class="form-control" name="address"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-check">
                          <input class="form-check-input" name="can_refer" type="checkbox" id="can_refer">
                          <label class="form-check-label" for="can_refer">
                            Puede Referir
                          </label>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center" style="padding-top: 20px;">
                    <button class="btn btn-primary" type="submit">añadir</button>
                </div>
            </form>
       </div>
   </div>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        @if($errors->any())
            Swal.fire({
                imageUrl:'/img/oops.png',
                html:'<span style="color:#808080; font-weight:bold; text-transform:capitalize;">debe llenar todos los campos</span>'
            });
        @endif

        @error('exist_dni')
            Swal.fire({
                imageUrl:'/img/oops.png',
                html:'<span style="color:#808080; font-weight:bold; text-transform:capitalize;">{{ $message }}</span>'
            });
        @enderror
    </script>
@stop