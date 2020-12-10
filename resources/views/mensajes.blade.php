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
                    <h2>Mensajes</h2>
                </div>
            </div>
            <div class="container">
                <h2>Enviados</h2>
                @foreach ($enviados as $e)
                <p>{{$e->texto}}</p><br>
                @endforeach
            </div>
            <div class="container">
                <h2>Recibidos</h2>
                @foreach ($recibidos as $r)
                <p>{{$r->texto}}</p><br>
                @endforeach
            </div>

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
