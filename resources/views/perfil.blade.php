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
                <div class="container row">
                    <div class="col-sm-10">
                        <h2>Perfil de {{ Auth::user()->name }}</h2>
                        @if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                    <div class=" col-sm-2 align-content-sm-end">
                        <div class="row">
                            <h3>{{ Auth::user()->creditCoins}}</h3>
                            <img src="{{ asset('/images/creditcoin.png') }}" style="padding-left: 10px; height: 40px"/>
                        </div>
                    </div>
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
                            <th>Asignatura</th>
                            <th>Nota</th>
                            <th>Curso</th>
                            <th>Convocatoria</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($asignaturasExp))
                            @if(empty($asignaturasExp))
                            <tr>
                                <td>NO HAY REGISTROS DE SU EXPEDIENTE</td>
                            </tr>
                            @else
                                @foreach ($asignaturasExp as $a)
                                <tr>
                                    <td>{{$a->nombre_asig}}</td>
                                    @if(empty($a->nota))
                                    <td>NP</td>
                                    @else
                                    <td>{{$a->nota}}</td>
                                    @endif
                                    <td>{{$a->curso}}</td>
                                    @if($a->convocatoria == -1)
                                        <td>Primera Matricula</td>
                                    @else
                                        @if($a->convocatoria == 1)
                                        <td>Febrero</td>
                                        @endif
                                        @if($a->convocatoria == 2)
                                        <td>Junio</td>
                                        @endif
                                        @if($a->convocatoria == 3)
                                        <td>Septiembre</td>
                                        @endif
                                    @endif
                                </tr>
                                @endforeach
                            @endif
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
