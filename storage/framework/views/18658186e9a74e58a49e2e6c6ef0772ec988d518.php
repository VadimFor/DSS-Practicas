<?php $__env->startSection('content'); ?>

    <form action="/registro" method="POST">
        <?php echo csrf_field(); ?>
        <h1>Registro</h1>
        <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password Confirmation</label>
            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
        </div>


        <button type="submit" class="btn btn-primary">Crear cuenta</button>
        <div> </div>
        <div class="">
            <a style="font-size:12px;" href="/login">Iniciar sesión</a>
        </div>
      </form>

<?php $__env->stopSection(); ?>
<?php /**PATH /home/vadym/Escritorio/DSS/dss/resources/views/registro-panel.blade.php ENDPATH**/ ?>