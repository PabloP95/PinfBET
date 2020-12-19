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
            @include('anuncios.anuncio1')
        </div>
        <div class="col-sm-8 text-left">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h2>Mensajes</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <h3>Contactos</h3>
                    @foreach ($amigos as $a)
                    <a href="#{{$a->name}}{{$a->surnames}}" aria-controls="{{$a->name}}{{$a->surnames}}" role="tab" data-toggle="tab">{{$a->name}} {{$a->surnames}}</a><br>
                    @endforeach
                </div>
                <div class="col-sm-8">
                    <h2>Conversaciones</h2>
                    @foreach ($mensajes as $m)
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="{{$a->name}}{{$a->surnames}}">
                            @if (Auth::User()->id == $m->emisor)
                            <!--//Si lo envio yo debería ponerse a la derecha-->
                            <b>Yo:{{$m->texto}}</b><br><br>
                            @else
                            <!--//Si me lo envian debería ponerse a la izquierda-->
                            <b>{{$a->name}} {{$a->surnames}}:{{$m->texto}}</b><br><br>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" rows="3" id="comment"></textarea>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="container">

            </div>
        </div>
        <div class="col-sm-2 sidenav">
            @include('anuncios.anuncio2')
        </div>
    </div>
</div>
@endsection
