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
       <h2>editar perfil</h2>
       <div class="card-body">
            <form autocomplete="off" method="POST" action="{{ route('update_profile') }}">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" value="{{ Auth::user()->name }}" name="name" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Apellido:</label>
                            <input type="text" value="{{ Auth::user()->last_name }}" name="last_name" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>CÉDULA DE CIUDADANÍA::</label>
                            <input type="text" value="{{ Auth::user()->dni }}" name="dni" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>fecha de nacimiento:</label>
                            <input type="date" name="birth_date" value="{{ Auth::user()->birth_date }}" class="form-control" />
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
                            <input type="text" value="{{ Auth::user()->email }}" name="email" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Numero de Telefono:</label>
                            <input type="text" value="{{ Auth::user()->phone }}" name="phone" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>localidad:</label>
                            <select class="form-control" name="locale">
                                <option value="">Seleccione</option>
                                @foreach($locales as $locale)
                                    <option value="{{ $locale['id'] }}" data-upz="{{ json_encode($locale['upz']) }}">{{ $locale['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>upz:</label>
                            <select class="form-control" name="upz">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Dirección:</label>
                    <textarea class="form-control" name="address">{{ Auth::user()->address }}</textarea>
                </div>
                <div class="form-group text-center" style="padding-top: 20px;">
                    <button class="btn btn-primary" type="submit">actualizar</button>
                </div>
            </form>
       </div>
   </div>
</div>
@endsection
@section('js')
    <script type="text/javascript">
        $("select[name='locale']").change(function(){
            let data = $(this).children("option:selected").attr("data-upz");
            if(data){
                let html = "<option value=''>Seleccione</option>";
                data = JSON.parse(data);
                console.log(data);
                data.forEach((e)=>{
                    html+="<option value='"+e.id+"'>"+e.name+"</option>";
                });
                $("select[name='upz']").html(html);
            }
            

        });
    </script>
@stop