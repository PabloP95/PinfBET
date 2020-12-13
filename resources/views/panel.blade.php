<!-- SECTION: Menu principal -->
@extends('layouts.master')
@section('titulo')
<title>Mi Perfil</title>
@endsection
<!-- LAYOUT: CENTER -->
<!-- BLOCK: CENTER -->
@section('content')
<div class="container p-3 text-white">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            @include('anuncios.anuncio1')
        </div>
        <div class="col-sm-10 text-left">
            <div class="jumbotron jumbotron-fluid">
                <div class="container row">
                    <div class="col-sm-11">
                        <h2>Panel social y apuestas de {{ Auth::user()->name }}</h2>
                    </div>
                    <div class=" col-sm-1 align-content-sm-end">
                        <h3>{{ Auth::user()->creditcoin }}</h3>
                        <img src="{{ asset('/images/creditcoin.png') }}" height="40px" />
                    </div>                    
                </div>
            </div>
            <div>
                Hola
            </div>
        </div>
    </div>
</div>
@endsection
