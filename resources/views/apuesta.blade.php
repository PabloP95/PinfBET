<!-- SECTION: Menu principal -->
@extends('layouts.master')
@section('titulo')
<title>Apostar</title>
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
                        <h2>Realizar apuesta</h2>
                    </div>
                    <div class=" col-sm-1 align-content-sm-end">
                        <div class="row">
                            <h3>{{ Auth::user()->creditCoins}}</h3>
                            <img src="{{ asset('/images/creditcoin.png') }}" style="padding-left: 8px; height: 40px"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <h3>Usuarios</h3>
                    <div class="tab-content">
                        <ul class="nav nav-pills nv-stackedarea" role="tablist">
                            <li role="presentation" class="list-group-item" style="width: 100%; background-color: transparent; border: none">
                                <form method="POST" action="/apuesta/{{ Auth::user()->id }}/{{Auth::user()->id}}">
                                    @csrf
                                    <button type="submit" name="amigo" value="{{Auth::user()->id}}" class="btn btn-success" style="width: 100%" >YO</button>
                                </form>
                            </li>
                            @if(isset($amigos))
                            @foreach($amigos as $am)
                            <li role="presentation" class="list-group-item" style="width: 100%; background-color: transparent; border: none">
                                <form method="POST" action="/apuesta/{{ Auth::user()->id }}/{{$am->id}}">
                                    @csrf
                                    <button type="submit" name="amigo" value="{{$am->id}}" class="btn btn-success" style="width: 100%" >{{$am->name}}  {{$am->surname1}} {{$am->surname2}}</button>
                                </form>
                            </li>
                            @endforeach
                            @endif
                    </div>
                </div>
                <div class="col-sm-8">
                    <h3>Asignaturas</h3>
                    <div class="tab-content">
                        @if(isset($_POST['amigo']))
                        <ul class="nav nav-pills nv-stackedarea" role="tablist">
                            @foreach($asignaturas as $a)
                            <li role="presentation" class="list-group-item" style="width: 100%; background-color: transparent; border: none">
                                <a href="/completarApuesta/{{ Auth::user()->id }}/{{$_POST['amigo']}}/{{$a->cod_asig}}" class="btn btn-success" style="width: 100%" >{{$a->nombre_asig}}</a><br>
                            </li>
                            @endforeach
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
