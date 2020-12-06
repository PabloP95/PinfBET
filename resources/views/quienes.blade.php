<!-- SECTION: Menu principal -->
@extends('layouts.master')
@section('titulo')
<title>Quienes somos</title>
@endsection
<!-- LAYOUT: CENTER -->
<!-- BLOCK: CENTER -->
@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Quienes somos</h1>
    </div>
</div>
<div class="container p-3 text-white">
    <div class="row">
        <div class="col-4 align-self-center">
            <img src="{{ asset('images/Logo.png') }}" class="img-thumbnail" alt="Equipo 5 S.L." width="70%" style="display: block; margin-left: auto; margin-right: auto;">
        </div>
        <div class="col-8 text-justify">
            <p>PINFbet es una idea original de PINF S.L., encargada a Grupo 5 S.L., siendo el primero un mecenazgo de ideas y aporte para dar vida esta emocionante e interesante web, donde no solo poder compartir tus triunfos académicos, sino darle emoción a la vez que lo consigues.</p>
            <p>Respecto a Grupo 5 S.L. somos una empresa de desarrollo y soluciones informáticas, en las que la satisfacción es nuestro sello de garantía y el secreto ponerle todo nuestro empeño y creatividad en cada proyecto.</p>
            <p>Juntos PINF S.L. y Grupo 5 S.L. por medio del tándem empresarial realizado este proyecto se encuentra vivo y activo, motivando al alumnado del Grado de Ingeniería Informática a alcanzar mejores resultados y de paso divertirse, porque no son incompatibles entre si.</p>
        </div>
    </div>
    <p class="row" style="height: 40px"></p>
    <div class="row">
        <div class="col-8 text-justify">
            <p>El equipo que ha hecho posible PINFbet es un grupo de trabajo donde no solo se trabaja, sino que se comparten experiencias, momentos de trabajo y momentos de esparcimiento. En los resultados esta visto el equipo lo conforman grandes profesionales, que sin ellos no habría sido posible el desarrollo de este sitio.</p>
            <p>Los primeros pasos, papel encargado de ello el personal de análisis, viendo con antelación la posibilidad de crecimiento del proyecto por su madurez y evolución.</p>
            <p>Continuado por el desarrollo y puesta en marcha de la idea en el papel a la existencia en funcionalidades encargado por el conjunto de desarrolladores del sitio web, trabajando por bloques que una vez finalizados encajan a la perfección.</p>
            <p>Y la armonización de todas las piezas dirigidas por el mánager del proyecto, que atento y con mimo ha ido viendo las necesidades del equipo y del proyecto para que todo acabe encajando.</p>
       </div>
        <div class="col-4 align-self-center">
            <img src="{{ asset('images/programando.jpg') }}" class="img-thumbnail" alt="Equipo 5 S.L." width="100%" style="display: block; margin: auto;">
        </div>
    </div>
    <p class="row" style="height: 40px"></p>
    <div class="row">
        <p>Si te interesa el proyecto y te gustaría unirte a nuestro equipo puedes enviar tu CV al siguiente correo y valoraremos tu propuesta: empleo@pinfbet.com</p>
    </div>
</div>
@endsection