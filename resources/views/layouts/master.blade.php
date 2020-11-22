<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="/css/font-awesome.min.css"/>
        <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">

        <style>
            .fakeimg { height: 100px; background: #aaa; }
            .aFooter{ text-decoration: none; color: black; }
            .ulEspaciado{padding-top: 5px;}
            .estiloOl{font-size: 30px; font-family: 'Quicksand', sans-serif; font-weight: bold; color: #9b9b9b;}
            .zoom {transition: transform .2s; /* Animation */}
            .zoom:hover {transform: scale(1.08);/* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */}
            .imagen{transition: transform .15s; /* Animation */;}
            .imagen:hover{ -webkit-transform: scale(1.5); transform: scale(1.5)}
            .tabla {text-align: center; width: 50px;}
            .btn-circle {
                width: 30px;
                height: 30px;
                padding: 6px 0px;
                border-radius: 15px;
                text-align: center;
                font-size: 12px;
                line-height: 1.42857;
            }
            .badge {
                padding-left: 9px;
                padding-right: 9px;
                -webkit-border-radius: 9px;
                -moz-border-radius: 9px;
                border-radius: 9px;
            }

            .label-warning[href], .badge-warning[href] { background-color: #c67605; }
            #lblCartCount {
                font-size: 12px;
                background: #37a098;
                color: #fff;
                padding: 0 5px;
                vertical-align: top;
            }


        </style>

        @yield('titulo')
    </head>

    <body>
        @include('layouts.header')
        <div class="container-fluid" style="margin-top:30px">
            @yield('content-center')
            <div class="row">
                <div class ="col-sm-10">
                    @yield('content')
                </div>
            </div>
            <!-- Sección -> Más vendidos -->
            <div class="col-sm-2 sidenav" style="background-color: #eeeeee">
                @yield('advertisement')
            </div>
        </div>
            @include ('layouts.footer')
            <!-- Loading Javascripts -->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <!--<script>window.jQuery || document.write('https://code.jquery.com/jquery-3.3.1.slim.min.js') integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
            <!-- <script src="/js/popper.min.js"></script> -->
            <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
