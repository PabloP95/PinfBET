<!-- SECTION: Menu principal -->
@extends('layouts.master')
@section('titulo')
    <title>PINFBet</title>
@endsection
<!-- LAYOUT: CENTER -->
<!-- BLOCK: CENTER -->
@section('content-center-publi')
<div class="row">
    <div class ="col-sm-10">
    <!-- Aqui se encuentran las apuestas -> Van a tener que cambiar, OJO -->
    <h3>Apuestas de hoy</h3>
    <!-- Ponemos otra fila dentro de la columna de 10 para poder poner las imagenes y precio correspondientes -->
    <div class="row">

    </div>

    <div class="row">
        <div class="col-md-10">
        <br>

        </div>
      </div>
  </div>
  <div class="col-sm-2 sidenav" style="background-color: gray">
    <!-- SECTION: anuncios -->
    <h2>Anuncios</h2>
    <div class="card card-body bg-faded" style="background-color: #0ff; margin-bottom:15px;">
      <h4 class="card-title">Anuncio 1</h4>
      <p class="card-text">Aqui pondremos un texto para el anuncio.</p>
      <a href="#" class="btn btn-primary">Boton anuncio 1</a>
    </div>
    <div class="card card-body bg-light" style="margin-bottom:15px;">
      <h4 class="card-title">Anuncio 2</h4>
      <div class="fakeimg">Imagen anuncio 2</div>
      <p class="card-text">Texto anuncio 2.</p>
    </div>
  </div>
</div>
@endsection
