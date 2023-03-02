<?php $__env->startSection('content'); ?>

<form action="/login" method="POST">
    <?php echo csrf_field(); ?>
    <h1>Login</h1>
    <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name ="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Recordarme</label>
    </div>
    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    <div> </div>
    <div class="">
        <a style="font-size:12px;" href="/register">Crear cuenta</a>
    </div>
</form>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.auth-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vadym/Escritorio/DSS/dss/resources/views/auth/login.blade.php ENDPATH**/ ?>