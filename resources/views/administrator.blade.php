@extends('layouts.app')

@section('title','Administracion')

@section('right-content')
<span class="user-name">{{ Auth::user()->name.' '.Auth::user()->last_name }}</span>
<a href="#" id="burger">
    <img src="/img/burger.png" />
</a>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/escritorio.css') }}" />
@stop

@section('content')
<div class="container-fluid" id="contenedor">
   <h3>Lista de Personas</h3>
   <hr />
   <form class="form">
	   	<div class="row">
	   		<div class="col-md-3">
	   			<input type="text" placeholder="Cedula de Ciudadania" value="{{ @$cc }}" name="dni" class="form-control" />
	   		</div>
	   		<div class="col-md-3">
	   			<select class="form-control" name="locale">
	   				<option value="">Localidad</option>
	   				@foreach($locales as $locale)
	   					<option value="{{ $locale['id'] }}" @if(@$lc == $locale['id']) selected="selected" @endif>{{ $locale['name'] }}</option>
	   				@endforeach
	   			</select>
	   		</div>
	   		<div class="col-md-3 text-center">
	   			<button class="btn btn-success" id="buscar_admin" type="button">Buscar</button>
	   		</div>

	   		<div class="col-md-3 text-center">
	   			<button class="btn bt-success" id="btn-export" style="color:white;" type="button">Exportar Registros</button>
	   		</div>
	   	</div>
   </form>

 

   <div style="overflow-x: auto;" id="all_peoples">
	    <table>
	        <thead>
	        	<th>Referido Por</th>
	            <th>Cc</th>
	            <th>Nombre</th>
	            <th>Apellido</th>
	            <th>Sexo</th>
	            <th>Fecha de nacimiento</th>
	            <th>Telefono</th>
	            <th>Correo</th>
	            <th>Localidad</th>
	            <th>Ver Referidos</th>
	        </thead>
	        <tbody>
	        	@foreach($data as $user)
	        		@php
	        			$referer = \App\Models\User::findorfail($user->parent_user_id)
	        		@endphp
	        		<tr>
	        			<td><a href="{{ route('show_friend',$referer->id) }}">{{ $referer->name.' '.$referer->last_name }}</a></td>
	        			<td>{{ $user->dni }}</td>
	        			<td>{{ $user->name }}</td>
	        			<td>{{ $user->last_name }}</td>
	        			<td>
	        				@if($user->sex == 'male')
	        					<span class="badge">Masculino</span>
	        				@else
	        					<span class="badge">Femenino</span>
	        				@endif
	        			</td>
	        			<td>{{ date('d-m-Y',strtotime($user->birth_date)) }}</td>
	        			<td>{{ $user->phone }}</td>
	        			<td>{{ $user->email }}</td>
	        			<td>
	        				@foreach($locales as $locale)
	        					@if($locale['id'] == $user->locale)
	        						{{ $locale['name'] }}
	        					@endif
	        				@endforeach
	        			</td>
	        			<td><a href="{{ route('show_friend',$user->id) }}">Ver</a></td>
	        			<td></td>
	        		</tr>
	        	@endforeach
	        </tbody>
	    </table>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	
	$(document).ready(function(){
		$("#buscar_admin").click(function(){
			let dni = $("input[name='dni']").val();
			let locale = $("select[name='locale']").val();
			if(!dni){
				dni = " ";
			}

			location.href="/administrator/"+dni+"/"+locale;
		});

		$("#btn-export").click(function(){
			window.open('data:application/vnd.ms-excel,' + $('#all_peoples').html());
    		e.preventDefault();
		});
	});
	
</script>
@stop