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
        <div class="col-sm-8 text-left">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h2>Perfil de {{ Auth::user()->name }}</h2>
                    @if (session('status'))
                    <div class="alert alert-danger">
                        {{ session('status') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="panel panel-primary">
                            <b>Nombre del usuario</b><br>
                            {{ Auth::user()->name }}<br><br>
                            <b>Apellidos del usuario</b><br>
                            {{ Auth::user()->surname1 }} {{ Auth::user()->surname2 }}<br><br>
                            <b>Su e-Mail</b><br>
                            {{ Auth::user()->email }}<br><br>
                            <b>CreditCoins disponibles</b><br>
                            {{ Auth::user()->creditCoins}}<br><br>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-primary">
                            <b>Apuestas ganadas</b><br>
                            {{$ganadas->total}}<br><br>
                            <b>Apuestas perdidas</b><br>
                            {{$perdidas->total}}<br><br>
                            <b>Apuestas realizadas</b><br>
                            {{$realizadas->total}}<br><br>
                            <a href="/apuesta/{{Auth::user()->id}}" class="btn btn-primary" role="button">Realizar apuesta</a>
                        </div>
                    </div>
                </div>
            </div><br><br>
            <hr>
            <h3>Datos del expediente</h3>
            <br>
            <h5>Tabla de calificaciones</h5>
            <p>Recuerda que la información que se visualiza a continuación es obtenido del expediente facilitado.</p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Siglas</th>
                            <th>Nota</th>
                            <th>Apuestas acertadas</th>
                            <th>Apuestas realizadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Proyectos Informáticos</td>
                            <td>PINF</td>
                            <td>10</td>
                            <td>8</td>
                            <td>24</td>
                        </tr>
                        @if(isset($expediente))
                        @foreach ($expediente as $i=>$e)
                        <tr>

                            <td>{{$e}}</td>
                            <td>{{$i}}</td>
                            <td>{{$linea2}}</td>
                            <td>{{$linea3}}</td>
                        </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <hr>
            <br><br>
            {{--@if ($propietario)--}}
                @include('perfil_cambio_datos')
            {{--@endif--}}
        </div>
        <div class="col-sm-2 sidenav">
            @include('anuncios.anuncio2')
        </div>
    </div>
</div>
@endsection
