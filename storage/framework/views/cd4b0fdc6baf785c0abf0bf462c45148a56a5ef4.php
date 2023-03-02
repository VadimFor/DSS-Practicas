<?php $__env->startSection('content'); ?>

    <h1 class='container'>Home</h1>

    <?php if(auth()->guard()->check()): ?>
    <p>Bienvenido <?php echo e(auth()->user()->name ?? auth()->user()->email); ?>,estás autenticado a la página</p>
    <p><a href="/logout">Logout</a></p>
    <?php endif; ?>

    <?php if(auth()->guard()->guest()): ?>
    <p>Para ver el contenido <a href ="/login">Inicia sesión </a></p>
    <?php endif; ?>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vadym/Escritorio/DSS/dss/resources/views/home/index.blade.php ENDPATH**/ ?>