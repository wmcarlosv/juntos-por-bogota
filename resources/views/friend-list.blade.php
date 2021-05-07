@extends('layouts.app')

@section('title','Escritorio')

@section('right-content')
<input type="text" placeholder="buscar" @if($tag) value="{{ $tag }}" style="visibility: visible;"  @else @endif style="visibility: hidden;" autocomplete="off" data-open="no" name="search" />
<a href="#" id="search">
    <img src="/img/search.png" />
</a>
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
    <div style="overflow-x: auto;">
    <table>
        <thead>
            <th>Dni</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha de Nacimiento</th>
            <th>Telefono</th>
            <th>Correo Electrónico</th>
            <th>Direccion</th>
            <th>/</th>
        </thead>
        <tbody>
            @if($users->count() == 0)
                <tr>
                    <td colspan="7" style="padding: 30px;" align="center">
                        @if($tag)
                            <h4>sin resultados</h4>
                        @else
                            <h4>aún no tiene registros</h4>
                        @endif
                    </td>
                </tr>
            @else
                @foreach($users as $us)
                    <tr>
                        <td>{{ $us->dni }}</td>
                        <td style="color:#3FA9F5;">{{ $us->name }}</td>
                        <td>{{ $us->last_name }}</td>
                        <td>{{ date('d-m-Y', strtotime($us->birth_date)) }}</td>
                        <td>{{ $us->phone }}</td>
                        <td>{{ $us->email }}</td>
                        <td style="color:#3FA9F5;">{{ $us->address }}</td>
                        <td style="width: 200px;">
                            <a href="{{ route('edit_friend',$us->id) }}" class="actions">Editar</a> / <form id="delete_{{ $us->id }}" action="{{ route('delete_friend',$us->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('delete')
                                <a href="#" data-id="{{ $us->id }}" class="actions delete">Eliminar</a> 
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-primary" id="add" type="button">añadir</button>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $("#add").click(function(){
            location.href="{{ route('add') }}";
        });

        $("a.delete").click(function(){
            let id = $(this).attr("data-id");
            if(confirm("Estas seguro de eliminar este Referido?")){
                $("form#delete_"+id).submit();
            }
        });

        $("a#search").click(function(){
            let s = $("input[name='search']").attr("data-open");
            if(s == 'no'){
                $("input[name='search']").css('visibility','visible').attr("data-open","si").focus().val("");
            }else{
                $("input[name='search']").css('visibility','hidden').attr("data-open","no");
            }
        });

        $("input[name='search']").keyup(function(e){
            let tag = $(this).val();
            if (e.key === 'Enter' || e.keyCode === 13) {
                location.href="{{ route('friend_list') }}/"+tag;
            }
        });

        @if($tag)
            $("input[name='search']").focus();
        @endif


        @if(Session::get('success'))
            Swal.fire('Juntos por Bogotá','{{ Session::get("success") }}','success');
        @endif

        @if(Session::get('error'))
            Swal.fire('Juntos por Bogotá','{{ Session::get("error") }}','error');
        @endif
    });
</script>
@stop