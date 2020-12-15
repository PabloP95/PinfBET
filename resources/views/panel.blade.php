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
        <div class="col-sm-10 text-left">
            <div class="jumbotron jumbotron-fluid">
                <div class="container row">
                    <div class="col-sm-11">
                        <h2>Panel social y apuestas de {{ Auth::user()->name }}</h2>
                    </div>
                    <div class=" col-sm-1 align-content-sm-end">
                        <div class="row">
                            <h3>{{ Auth::user()->creditcoin }}</h3>
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
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Equipo 5</td>
                            <td>PINF</td>
                            <td>10</td>
                            <td>10.000.000 creditcoins</td>
                        </tr>
                        {{--@foreach ($apuestas as $apuesta) --}}
<!--                        <tr>
                            <td>{{-- $apuesta->usuarioName --}}</td>
                            <td>{{-- $apuesta->asignatura --}}</td>
                            <td>{{-- $apuesta->nota --}}</td>
                            <td>{{-- $apuesta->cantidad --}}</td>
                        </tr>-->
                        {{--@endforeach --}}
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
                            <div class="row">
                                <div class="col-sm-6">
                                    Grupo 5
                                </div>
                                <div class="col-sm-4 text-right">
                                    50 <img src="{{ asset('/images/creditcoin.png') }}" style="padding-left: 10px; height: 20px"/>
                                </div>
                                <div class="col-sm-2">
                                    <img src="{{ asset('/images/mensaje.png') }}" alt="enviar mensaje" height="30px"/>
                                </div>
                            </div>
                            {{--@foreach ($amigos as $amigo) --}}
<!--                            <div class="row">
                                <div class="col-sm-6">
                                    {{-- $aamigo->usuarioName --}}
                                </div>
                                <div class="col-sm-4 text-right">
                                    {{-- $amigo->creditcpoins --}} <img src="{{ asset('/images/creditcoin.png') }}" style="padding-left: 10px; height: 20px"/>
                                </div>
                                <div class="col-sm-2">
                                    <img src="{{ asset('/images/mensaje.png') }}" alt="enviar mensaje" height="30px"/>
                                </div>
                            </div>-->
                            {{--@endforeach --}}
                        </div>
                    </div>
                    <br>
                    {{--@if (count($record)> 1)--}}
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Solicitudes pendientes</h5>
                            <div class="row">
                                <div class="col-sm-8">
                                    Grupo 6
                                </div>
                                <div class="col-sm-2 text-right">
                                    <img src="{{ asset('/images/yes.png') }}" style="padding-left: 10px; height: 20px"/>
                                </div>
                                <div class="col-sm-2">
                                    <img src="{{ asset('/images/no.png') }}" alt="enviar mensaje" height="20px"/>
                                </div>
                            </div>
                            {{--@foreach ($conocidos as $conocido) --}}
<!--                            <div class="row">
                                <div class="col-sm-8">
                                    {{-- $conocido->usuarioName --}}
                                </div>
                                <div class="col-sm-2 text-right">
                                    <img src="{{ asset('/images/yes.png') }}" style="padding-left: 10px; height: 20px"/>
                                </div>
                                <div class="col-sm-2">
                                    <img src="{{ asset('/images/no.png') }}" alt="enviar mensaje" height="20px"/>
                                </div>
                            </div>-->
                            {{--@endforeach --}}
                        </div>
                    </div>
                    {{--@endif--}}
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Buscador</h5>
                            <input id="buscador" type="text" class="form-control" name="buscador" value="">
                            <br>
                            <h6>Usuarios disponibles</h6>
                            <div class="row">
                                <div class="col-sm-10">
                                    Grupo 6
                                </div>
                                <div class="col-sm-2 text-right">
                                    <img src="{{ asset('/images/yes.png') }}" style="padding-left: 10px; height: 20px"/>
                                </div>
                            </div>
                            {{--@foreach ($buscados as $buscado) --}}
<!--                            <div class="row">
                                <div class="col-sm-10">
                                    {{-- $buscado->usuarioName --}}
                                </div>
                                <div class="col-sm-2 text-right">
                                    <img src="{{ asset('/images/yes.png') }}" style="padding-left: 10px; height: 20px"/>
                                </div>
                            </div>-->
                            {{--@endforeach --}}
                        </div>
                    </div>                    
                </div>
                <div class="col-sm-6">
                    <h5>Posibles apuestas</h5>
                    <div class="table-responsive">          
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Asignatura</th>
                                    <th>Nota media</th>
                                    <th>Apuesta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Equipo 5</td>
                                    <td>PINF</td>
                                    <td>10</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-warning">Apostar</button>
                                    </td>
                                </tr>
                                {{--@foreach ($posiblesApuestas as $posibleApuesta) --}}
<!--                                <tr>
                                    <td>{{-- $posibleApuesta->usuarioName --}}</td>
                                    <td>{{-- $posibleApuesta->asignatura --}}</td>
                                    <td>{{-- $posibleApuesta->media --}}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-warning">Apostar</button>
                                    </td>
                                </tr>-->
                                {{--@endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection