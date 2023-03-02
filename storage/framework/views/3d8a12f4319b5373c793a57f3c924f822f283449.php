<div class="row my-5">
    <h3 class="fs-4 mb-3">Usuarios</h3>

    <?php if(session("correcto")): ?>
        <div class="aler alert-success"><?php echo e(session("correcto")); ?></div>
    <?php endif; ?>
    <?php if(session("incorrecto")): ?>
    <div class="aler alert-danger"><?php echo e(session("incorrecto")); ?></div>
    <?php endif; ?>

    <script>
        var res=function($email){
            var not=confirm("¿Eliminar a " + $email + " ?");
            return not;
        }
    </script>

    <div class="p-5 table-responsive">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario">Crear usuario</button>

        <!-- Modal de crear usuario-->
        <div class="modal fade" id="modalCrearUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear usuario</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route("home.crearuser")); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="" aria-describedby="emailHelp">
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nombre </label>
                          <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Contraseña</label>
                          <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Verificar contraseña</label>
                            <input type="text" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="">
                          </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                      </form>

                </div>
            </div>
            </div>
        </div>

        <table class="table bg-white rounded shadow-sm table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">password</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <th><?php echo e($item->id); ?></th>
                    <td><?php echo e($item->name); ?></td>
                    <td><?php echo e($item->email); ?></td>
                    <td><?php echo e($item->password); ?></td>
                    <td>
                        <a href=""  data-bs-toggle="modal" data-bs-target="#modalEditar<?php echo e($item->id); ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="<?php echo e(route("home.deluser",$item->email)); ?>" onclick="res('<?php echo e($item->email); ?>')"  class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                    </td>

                    <!-- Modal de modificar datos de la tabla-->
                    <div class="modal fade" id="modalEditar<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modificar usuario</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">

                                <form action="<?php echo e(route("home.moduser")); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">id</label>
                                        <input type="email" name="id" class="form-control" id="exampleInputEmail1" placeholder="" value=<?php echo e($item->id); ?> readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="" value=<?php echo e($item->email); ?> readonly>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Nombre</label>
                                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="" value=<?php echo e($item->name); ?>>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Contraseña</label>
                                      <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="" >
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                  </form>

                            </div>
                        </div>
                        </div>
                    </div>

                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
        </table>


    </div>
</div>
<?php /**PATH /home/vadym/Escritorio/DSS/dss/resources/views/panel1.blade.php ENDPATH**/ ?>