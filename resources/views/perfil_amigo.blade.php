<!-- SECTION: Menu principal -->
@extends('layouts.master')
@section('titulo')
<title>Perfil de {{$amigo->name}}</title>
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
                    <h2>Perfil de su amigo {{$amigo->name }} {{$amigo->surname1 }}</h2>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="panel panel-primary">
                            <b>Nombre del amigo</b><br>
                            {{ $amigo->name }}<br><br>
                            <b>Apellidos del amigo</b><br>
                            {{$amigo->surname1 }} {{$amigo->surname2 }}<br><br>
                            <b>Su e-Mail</b><br>
                            {{$amigo->email }}<br><br>
                            <b>CreditCoins disponibles</b><br>
                            {{$amigo->creditCoins}}<br><br>
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
                        {{--@foreach ($asignaturas as $asignatura) --}}
<!--                        <tr>
                            <td>{{-- $asignatura->name --}}</td>
                            <td>{{-- $asignatura->sigla --}}</td>
                            <td>{{-- $asignatura->nota --}}</td>
                            <td>{{-- $asignatura->acertadas --}}</td>
                            <td>{{-- $asignatura->realizadas --}}</td>
                        </tr>-->
                        {{--@endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-2 sidenav">
            @include('anuncios.anuncio2')
        </div>
    </div>
</div>
@endsection
