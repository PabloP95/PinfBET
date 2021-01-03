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
                    <ul class="nav nav-pills nv-stackedarea" role="tablist">
                        <li role="presentation" class="list-group-item" style="width: 100%; background-color: transparent; border: none">
                            <a class="btn btn-success" style="width: 100%" href="#Vacio" aria-controls="Vacio" role="tab" data-toggle="tab">Vacio</a><br>
                        </li>
                        @if(isset($amigos))
                        @foreach($amigos as $a)
                        <li role="presentation" class="list-group-item" style="width: 100%; background-color: transparent; border: none">
                            <a class="btn btn-success" style="width: 100%" href="#{{$a->name}}{{$a->surnames}}" aria-controls="{{$a->name}}{{$a->surnames}}" role="tab" data-toggle="tab">{{$a->name}} {{$a->surnames}}</a><br>
                        </li>
                        @endforeach
                        @endif
                </div>
                <div class="col-sm-8">
                    <h2>Conversación</h2>
                    @if(isset($a))
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade " id="Vacio" style="max-height: 400px; overflow: auto">
                            Selecciona un amigo para ver el chat
                        </div>
                        @foreach($amigos as $a)
                        <div role="tabpanel" class="tab-pane fade" id="{{$a->name}}{{$a->surnames}}" >
                            <div id="charla" onload="updateScroll()" style="max-height: 400px; overflow: auto">
                                @foreach($mensajes as $sms)
                                @if(Auth::User()->id == $sms->emisor || Auth::User()->id == $sms->receptor)
                                @if(Auth::User()->id == $sms->emisor)
                                <!--//Si lo envio yo debería ponerse a la derecha-->
                                <div class="Yo">
                                    <span>{{ $sms->fecha }}</span><br>
                                    <b>Yo: {{ $sms->texto }}</b><br><br>
                                </div>
                                @else
                                <!--//Si me lo envian debería ponerse a la izquierda-->
                                <div class="d-flex flex-row-reverse">
                                    <div class="contacto">
                                        <span>{{ $sms->fecha }}</span><br>
                                        <b>{{ $a->name }} {{ $a->surnames }}: {{ $sms->texto }}</b><br><br>
                                    </div>
                                </div>
                                @endif
                                @endif
                                @endforeach
                            </div>
                            <hr>
                            <form method="POST" action="/mensajes/{{ Auth::user()->id }}/{{ $a->id }}" id="teclado">
                                @csrf
                                <input type="text" autocomplete='off' name="mensaje" placeholder="Escribe un mensaje" required>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar') }}
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @endif
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
