<!-- SECTION: Menu principal -->
<!-- SECTION: Menu principal -->
@extends('layouts.master')
@section('titulo')
<title>Completar Apuesta</title>
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
                    <div class="col-sm-11">
                        <h2>Completar apuesta</h2>
                        @if (session('status'))
                        <div class="alert alert-warning">
                            {{ session('status') }}
                        </div>
                        @endif
                    </div>
                    <div class=" col-sm-1 align-content-sm-end">
                        <div class="row">
                            <h3>{{ Auth::user()->creditCoins}}</h3>
                            <img src="{{ asset('/images/creditcoin.png') }}" style="padding-left: 8px; height: 40px"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <h3>Apuesta de la asignatura {{$asignatura->nombre_asig}} cursada por {{$amigo->name}} {{$amigo->surnames}}</h3>
                </div>
                <form method="POST" action="/completarApuesta/subir/{{Auth::user()->id}}/{{$amigo->id}}/{{$asignatura->cod_asig}}">
                    @csrf
                    <input type="hidden" name="mismonedas" value={{Auth::user()->creditCoins}}>
                    <label for="fname">Nota de apuesta: </label>
                    <input type="number" name="notaApuesta" autocomplete="off" required><br>
                    <label for="lname">CreditCoins apostadas: </label>
                    <input type="number" name="creditCoins" autocomplete="off" required><br><br>
                    <input type="submit" name="enviarApuesta" value="APOSTAR">
                </form>
            </div>
        </div>

        </div>
        <div class="col-sm-2 sidenav">
            @include('anuncios.anuncio2')
        </div>
</div>

@endsection
