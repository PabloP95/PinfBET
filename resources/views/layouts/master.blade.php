<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />
        <link rel="stylesheet" href="/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="/css/font-awesome.min.css"/>
        <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <link rel="stylesheet" href="/css/propio.css"/>
        <style>
            <!-- prueba rapida de estilo -->
        </style>
        @yield('titulo')
    </head>
    <body style="background: black">
        <a class="ir-arriba" id="myBtn" onclick="topFunction()" title="Volver arriba">
            <span class=" fa-stack ">
                <img src="{{ asset('/images/flecha.png') }}" alt="flecha arriba" height="100%" class="mx-auto d-block"/>
            </span>
        </a>
        @include('layouts.header')
        @include('layouts.navbar')
        <div class="container-fluid" style="background:gray; width:99%; color: white">
            @yield('content')
        </div>
        @include('layouts.messbar')
        @include ('layouts.footer')
        <!-- Loading Javascripts -->
        <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
        <!--<script>window.jQuery || document.write('https://code.jquery.com/jquery-3.3.1.slim.min.js') integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
        <!-- <script src="/js/popper.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/propio.js"></script>
    </body>
</html>
