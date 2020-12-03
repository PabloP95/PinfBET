<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="/css/font-awesome.min.css"/>
        <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <style>
            .fakeimg { height: 100px; background: #aaa; }
            .aFooter{ text-decoration: none; color: #d4ac0d;}
            .footer{ left: 0; bottom: 0; width: 100%;}
            .ulEspaciado{padding-top: 5px;}
            .estiloOl{font-size: 30px; font-family: 'Quicksand', sans-serif; font-weight: bold; color: #9b9b9b;}
            .zoom {transition: transform .2s; /* Animation */}
            .zoom:hover {transform: scale(1.08);/* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */}
            .imagen{transition: transform .15s; /* Animation */;}
            .imagen:hover{ -webkit-transform: scale(1.5); transform: scale(1.5)}
            .tabla {text-align: center; width: 50px;}
            .btn-circle {width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;}
            .badge {padding-left: 9px; padding-right: 9px; -webkit-border-radius: 9px; -moz-border-radius: 9px; border-radius: 9px;}
            .label-warning[href], .badge-warning[href] { background-color: #c67605; }
            a:hover {color: #71d500}
            a:link, a:visited, a:active {text-decoration:none;}
            #lblCartCount {font-size: 12px; background: #37a098; color: #fff; padding: 0 5px; vertical-align: top;}
        </style>
        @yield('titulo')
    </head>
    <body style="background: black">
        @include('layouts.header')
        @include('layouts.navbar')
        <div class="container-fluid" style="background:gray; width:99%">
            @yield('content')
        </div>
        @include ('layouts.footer')
        <!-- Loading Javascripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <!--<script>window.jQuery || document.write('https://code.jquery.com/jquery-3.3.1.slim.min.js') integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
        <!-- <script src="/js/popper.min.js"></script> -->
        <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
