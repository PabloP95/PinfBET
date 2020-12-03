<!-- SECTION: Menu principal -->

<?php $__env->startSection('titulo'); ?>
    <title>PINFBet</title>
<?php $__env->stopSection(); ?>
<!-- BLOCK: CENTER -->
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class ="col-sm-9">
    <h3>Apuestas de hoy</h3>
    <!-- Bloque del centro-->
  </div>
  <div class="col-sm-3" style="background-color: gray">
    <!-- SECTION: anuncios -->
    <h2>Anuncios</h2>
    <div class="card card-body bg-faded" style="background-color: #0ff; margin-bottom:15px;">
      <?php echo $__env->make('anuncios.anuncio1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="card card-body bg-light" style="margin-bottom:15px;">
      <?php echo $__env->make('anuncios.anuncio2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PinfBET\resources\views/welcome.blade.php ENDPATH**/ ?>