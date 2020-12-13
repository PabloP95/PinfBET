<!-- SECTION: Menu principal -->
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
                    <h2>Mensajes</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <h3>Contactos</h3>
                </div>
                <div class="col-sm-8">
                    
                </div>
            </div> 
            <div class="container">
                <h2>Enviados</h2>
                @foreach ($enviados as $e)
                <b>{{$e->texto}}</b><br>
                @endforeach
            </div>
            <div class="container">
                <h2>Recibidos</h2>
                @foreach ($recibidos as $r)
                <b>{{$r->texto}}</b><br>
                @endforeach
            </div>

        </div>

        <div class="col-sm-2 sidenav">
            @include('anuncios.anuncio2')
        </div>
    </div>
</div>
@endsection
