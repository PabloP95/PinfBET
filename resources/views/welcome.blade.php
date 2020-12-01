<!-- SECTION: Menu principal -->
@extends('layouts.master')
@section('titulo')
    <title>PINFBet</title>
@endsection
<!-- BLOCK: CENTER -->
@section('content')
<div class="row">
    <div class ="col-sm-9">
    <h3>Apuestas de hoy</h3>
    <!-- Bloque del centro-->
  </div>
  <div class="col-sm-3" style="background-color: gray">
    <!-- SECTION: anuncios -->
    <h2>Anuncios</h2>
    <div class="card card-body bg-faded" style="background-color: #0ff; margin-bottom:15px;">
      @include('anuncios.anuncio1')
    </div>
    <div class="card card-body bg-light" style="margin-bottom:15px;">
      @include('anuncios.anuncio2')
    </div>
  </div>
</div>
@endsection
