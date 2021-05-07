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
	   			<input type="text" placeholder="Cedula de Ciudadania" name="dni" class="form-control" />
	   		</div>
	   		<div class="col-md-3">
	   			<select class="form-control" name="locale">
	   				<option value="">Localidad</option>
	   				@foreach($locales as $locale)
	   					<option value="{{ $locale['id'] }}" data-upz="{{ json_encode($locale['upz']) }}">{{ $locale['name'] }}</option>
	   				@endforeach
	   			</select>
	   		</div>
	   		<div class="col-md-3">
	   			<select class="form-control" name="upz">
	   				<option value="">Upz</option>
	   			</select>
	   		</div>
	   		<div class="col-md-3">
	   			<button class="btn btn-success" type="button">Buscar</button>
	   		</div>
	   	</div>
   </form>
   <div style="overflow-x: auto;">
	    <table>
	        <thead>
	        	<th>Referido Por</th>
	            <th>Dni</th>
	            <th>Nombre</th>
	            <th>Apellido</th>
	            <th>Sexo</th>
	            <th>Localidad</th>
	            <th>Upz</th>
	            <th>informacion completa</th>
	            <th>Referidos</th>
	        </thead>
	        <tbody>
	        	@foreach($users as $user)
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
	        			<td>
	        				@foreach($locales as $locale)
	        					@if($locale['id'] == $user->locale)
	        						{{ $locale['name'] }}
	        					@endif
	        				@endforeach
	        			</td>
	        			<td>
	        				@foreach($locales as $locale)
	        					@if($locale['id'] == $user->locale)
	        						@foreach($locale['upz'] as $upz)
	        							@if($upz['id'] == $user->upz)
	        								{{ $upz['name'] }}
	        							@endif
	        						@endforeach
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
	$("select[name='locale']").change(function(){
            let data = $(this).children("option:selected").attr("data-upz");
            if(data){
                let html = "<option value=''>Upz</option>";
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