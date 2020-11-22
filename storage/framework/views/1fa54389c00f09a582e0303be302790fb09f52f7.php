<!-- SECTION: Menu principal -->

<?php $__env->startSection('titulo'); ?>
    <title>PINFBet</title>
<?php $__env->stopSection(); ?>
<!-- OJO, esto puede cambiar si el usuario se mete. Así que habria que poner un section y un yield -->


<!-- LAYOUT: CENTER -->
<!-- BLOCK: CENTER -->
<?php $__env->startSection('content'); ?>
    <!-- Aqui se encuentran las apuestas -> Van a tener que cambiar, OJO -->
    <h3>Apuestas de hoy</h3>
    <!-- Ponemos otra fila dentro de la columna de 10 para poder poner las imagenes y precio correspondientes -->
    <div class="row">

    </div>

    <div class="row">
        <div class="col-md-10">
        <br>

        </div>
<?php $__env->stopSection(); ?>
<!-- BLOCK: RIGHT -->
<!-- Bloque de la derecha, donde se encuentran los artículos más vendidos -->
<!-- Como puede cambiar, haría falta poner un section y un yield en el master -->
    <?php $__env->startSection('advertisement'); ?>
        <!-- SECTION: Los más vendidos -->
          <h2>Anuncios</h2>
          <div class="card card-body bg-faded" style="background-color: #0ff; margin-bottom:15px;">
            <h4 class="card-title">Anuncio 1</h4>
            <p class="card-text">Aqui pondremos un texto para el anuncio.</p>
            <a href="#" class="btn btn-primary">Boton anuncio 1</a>
          </div>
          <div class="card card-body bg-light" style="margin-bottom:15px;">
            <h4 class="card-title">Anuncio 2</h4>
            <div class="fakeimg">Imagen anuncio 2</div>
            <p class="card-text">Texto anuncio 2.</p>
          </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PinfBET\resources\views/welcome.blade.php ENDPATH**/ ?>