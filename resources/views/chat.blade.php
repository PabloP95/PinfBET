<!-- SECTION: Un mensaje -->
@extends('layouts.master')
@section('titulo')
<title>Mensajes</title>
@endsection
<!-- LAYOUT: CENTER -->
<!-- BLOCK: CENTER -->
@section('content')
<div class="container p-3 text-white">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            @include('anuncios.anuncio1')
        </div>
        <div class="col-sm-8 text-left">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h2>Chat con {{$amigo[0]->name}} {{$amigo[0]->surnames}}</h2>
                </div>
            </div>
            <div class="container">

                    <?php
                    foreach ($mensajes as $m){
                        if(Auth::User()->id == $m->emisor)
                            //Si lo envio yo debería ponerse a la derecha
                            echo "<b>".$m->texto."</b><br><br>";
                        else
                            //Si me lo envian debería ponerse a la izquierda
                            echo "<b>".$m->texto."</b><br><br>";
                    }
                    ?>

            </div>
            <div class="card-body">
                <form method="POST" action="/chat/{{Auth::User()->id}}/{{$amigo[0]->id}}">
                    @csrf
                    <input type="text" name="mensaje" placeholder="Escribe un mensaje">
                    <br>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Enviar') }}
                    </button>
                </form>
            </div>

            </div>
        </div>

        <div class="col-sm-2 sidenav">
            @include('anuncios.anuncio2')
    </div>
</div>
@endsection
