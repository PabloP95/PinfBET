<!-- SECTION: Menu principal -->
@extends('layouts.master')
@section('titulo')
<title>Quienes somos</title>
@endsection
<!-- LAYOUT: CENTER -->
<!-- BLOCK: CENTER -->
@section('content')
<div class="container p-3 text-white">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <div class="well">
                <img src="{{ asset('/images/getMeTheMoney2.png') }}" height="20%"/>
            </div>
            <hr>
            <div class="well">
                <img src="{{ asset('/images/getMeTheMoney.png') }}" height="20%"/>
            </div>
        </div>
        <div class="col-sm-8 text-left">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h2>Perfil de {{ Auth::user()->name }}</h2>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="panel panel-primary">
                            <b>Nombre del usuario</b><br>
                            {{ Auth::user()->name }}<br><br>
                            <b>Su e-Mail</b><br>
                            {{ Auth::user()->email }}<br><br>
                            <b>CreditCoins disponibles</b><br>
                            {{ Auth::user()->creditCoins}}<br><br>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-primary">
                            <b>Apuestas ganadas</b><br>
                            0<br><br>
                            <b>Apuestas perdidas</b><br>
                            0<br><br>
                            <b>Apuestas realizadas</b><br>
                            0<br><br>
                            <a href="#" class="btn btn-primary" role="button">Realizar apuesta</a>
                        </div>
                    </div>
                </div>
            </div><br><br>
            <hr>
            <h3>Actualiza tu información</h3>
            <p>Formulario para cambiar los datos que se puedan</p>
        </div>
        <div class="col-sm-2 sidenav">
            <div class="well">
                <img src="{{ asset('/images/getMeTheMoney.png') }}" height="20%"/>
            </div>
            <hr>
            <div class="well">
                <img src="{{ asset('/images/getMeTheMoney2.png') }}" height="20%"/>
            </div>
        </div>
    </div>
</div>
@endsection
