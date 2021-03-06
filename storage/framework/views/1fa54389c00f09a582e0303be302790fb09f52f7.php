<!-- SECTION: Menu principal -->

<?php $__env->startSection('titulo'); ?>
    <title>PINFBet</title>
<?php $__env->stopSection(); ?>
<!-- BLOCK: CENTER -->
<?php $__env->startSection('content'); ?>
<div class="row">
    <div id="demo" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
      </ul>

      <!-- The slideshow -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?php echo e(asset('images/felicidad.png')); ?>" alt="Felicidad" width="100%">
        </div>
        <div class="carousel-item">
          <img src="<?php echo e(asset('images/promo_amigo.png')); ?>" alt="Por cada amigo una creditcoin" width="100%">
        </div>
        <div class="carousel-item">
          <img src="<?php echo e(asset('images/promo_nuevo.png')); ?>" alt="Nuevo, keep calm, registrate y te regalamos 5 creditcoins" width="100%">
        </div>
      </div>

      <!-- Left and right controls -->
      <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PinfBET\resources\views/welcome.blade.php ENDPATH**/ ?>