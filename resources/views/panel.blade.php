<!-- SECTION: Menu principal -->
@extends('layouts.master')
@section('titulo')
<title>Mi Panel</title>
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
                        <h2>Panel social y apuestas de {{ Auth::user()->name }}</h2>
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                    </div>

                    <div class=" col-sm-1 align-content-sm-end">
                        <div class="row">
                            <h3>{{ Auth::user()->creditCoins}}</h3>
                            <img src="{{ asset('/images/creditcoin.png') }}" style="padding-left: 10px; height: 40px"/>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <h5>Apuestas realizadas</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Asignatura</th>
                            <th>Nota</th>
                            <th>Cantidad apostada</th>
                            <th>Resultado</th>
                            <th>Premio</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($apuestas as $apuesta)
                        <tr>
                            <td>{{$apuesta->name}}</td>
                            <td>{{$apuesta->asignatura}}</td>
                            <td>{{$apuesta->nota}}</td>
                            <td>{{$apuesta->cantidad}}</td>
                            <td>{{$apuesta->cantidad}}</td>
                            <td>{{$apuesta->cantidad}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <hr>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Amigos</h5>
                            @if(isset($amigos))
                            @foreach ($amigos as $amigo)
                            <div class="row">
                                <div class="col-sm-6">
                                    <a  href="/perfil/{{Auth::User()->id}}/{{$amigo->id}}" style="color: #71d500" title="Ver Perfil" >
                                        {{$amigo->name}} {{$amigo->surname1}} {{$amigo->surname2}}
                                    </a>
                                </div>
                                <div class="col-sm-4 text-right">
                                    {{$amigo->creditCoins}} <img src="{{ asset('/images/creditcoin.png') }}" style="padding-left: 10px; height: 30px"/>
                                </div>
                                <div class="col-sm-2">
                                    <a href="/mensajes/{{Auth::user()->id}}">
                                    <img src="{{ asset('/images/mensaje.png') }}" alt="enviar mensaje" height="40px"/>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            @if(empty($amigos))
                            <div class="row">
                                <div class="col-sm-6">
                                    <span><strong> No tienes amigos</strong> </span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <br>
                    @if(!empty($pendientes))
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Solicitudes pendientes</h5>

                            @foreach ($pendientes as $p)
                            <div class="row">
                                <div class="col-sm-8">
                                    <a style="color: #d4ac0d" href="/perfil/{{Auth::User()->id}}/{{$p->id}}" title="Ver Perfil" >
                                        {{$p->name}} {{$p->surname1}} {{$p->surname2}}
                                    </a>
                                </div>
                                <div class="col-sm-2 text-right">
                                    <a href="/panel/{{Auth::user()->id}}/{{$p->id}}/aceptar" title="Aceptar solicitud">
                                        <img src="{{ asset('/images/yes.png') }}" style="padding-left: 10px; height: 25px"/>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="/panel/{{Auth::user()->id}}/{{$p->id}}/rechazar" title="Rechazar solicitud">
                                        <img src="{{ asset('/images/no.png') }}"  height="25px"/>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Buscador</h5>
                            <form id="buscador" method="POST" action="/panel/{{Auth::user()->id}}">
                                @csrf
                                <input name="busqueda" type="text" class="form-control" name="buscador" value="" autofocus>
                                <input type="submit" class="btn btn-primary" style="margin-top: 10px;" name="buscar" value="Buscar">
                            </form>
                            <br>
                            @if(isset($buscadosAmigos) && isset($buscadosNoamig))
                                @if(!empty($buscadosNoamig) || !empty($buscadosAmigos))
                                    <h5>Usuarios disponibles</h5>
                                    @if(!empty($buscadosNoamig))
                                        @foreach($buscadosNoamig as $bna)
                                            <div class="row">
                                                <div class="col-sm-10">
                                                        <a style="color: white" href="/perfil/{{Auth::User()->id}}/{{$bna->id}}" title="Ver Perfil" >
                                                            {{$bna->name}} {{$bna->surname1}} {{$bna->surname2}}
                                                        </a>
                                                </div>
                                                    <div class="col-sm-2 text-right">
                                                        <a href="/panel/{{Auth::User()->id}}/{{$bna->id}}" title="Enviar solicitud" ><img src="{{ asset('/images/yes.png') }}" style="padding-left: 10px; height: 25px"/></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if(!empty($buscadosAmigos))
                                        @foreach($buscadosAmigos as $bna)
                                            @if($bna->pendiente == 0)
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <a style="color: #71d500" href="/perfil/{{Auth::User()->id}}/{{$bna->id}}" title="Ver Perfil" >
                                                            {{$bna->name}} {{$bna->surname1}} {{$bna->surname2}}
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-2 text-right">
                                                        <span><strong>Amigo</strong> </span>
                                                    </div>
                                                <div>
                                            @else
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <a style="color: #d4ac0d" href="/perfil/{{Auth::User()->id}}/{{$bna->id}}" title="Ver Perfil" >
                                                            {{$bna->name}} {{$bna->surname1}} {{$bna->surname2}}
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-2 text-right">
                                                        <span><strong>Pendiente</strong> </span>
                                                    </div>
                                                <div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
