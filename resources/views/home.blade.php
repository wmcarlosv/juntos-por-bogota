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
    <h1 style="text-transform: none;">¡Hola! <span style="text-transform: capitalize;">{{ Auth::user()->name.' '.Auth::user()->last_name }}</span></h1>
    <div class="row">
        <div class="col-md-12 text-center" id="zone-result-friends">
            <h1>tienes {{ $users->count() }} amigos</h1>
            <img src="/img/bienvenida.png" id="img_welcome" />
            <h1>¿QUIERES AÑADIR MÁS AMIGOS?</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-primary" id="add" type="button">añadir</button>
            <button class="btn btn-primary" onclick="javascript:location.href='/friend-list';" type="button">ir a lista</button>
        </div>
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