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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>CÉDULA DE CIUDADANÍA:</label>
                            <input type="text" name="dni" value="{{ $friend->dni }}" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>fecha de nacimiento:</label>
                            <input type="date" name="birth_date" value="{{ $friend->birth_date }}" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sexo:</label>
                            <select class="form-control" name="sex">
                                <option value="male" @if($friend->sex == 'male') selected='selected' @endif>Masculino</option>
                                <option value="female" @if($friend->sex == 'female') selected='selected' @endif>Femenino</option>
                            </select>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>localidad:</label>
                            <select class="form-control" name="locale">
                                <option value="">Seleccione</option>
                                @foreach($locales as $locale)
                                    <option value="{{ $locale['id'] }}" @if($locale['id'] == $friend->locale) selected='selected' @endif data-upz="{{ json_encode($locale['upz']) }}">{{ $locale['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>upz:</label>
                            <select class="form-control" name="upz">
                                <option value="">Seleccione</option>
                                @if($friend->upz)
                                    @foreach($locales as $locale)
                                        @if($locale['id'] == $friend->locale)
                                            @foreach($locale['upz'] as $upz)
                                                <option value="{{ $upz['id'] }}" @if($upz['id'] == $friend->upz) selected='selected' @endif>{{ $upz['name'] }}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            </select>
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

        @if($errors->all())
            Swal.fire({
                imageUrl:'/img/oops.png',
                html:'<span style="color:#808080; font-weight:bold; text-transform:capitalize;">debe llenar todos los campos</span>'
            });
        @endif
    </script>
@stop