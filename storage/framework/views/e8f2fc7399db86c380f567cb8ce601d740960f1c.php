<div class="p-5 table-responsive">
<div class="row g-3 my-2">
    <div class="col-md-3" style="text-align:center;">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2"><?php echo e($restaurante); ?></h3>
                <p class="fs-5">Restaurantes</p>
            </div>
            <i class="fas fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>

    <div class="col-md-3" style="text-align:center;">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2"><?php echo e($menu); ?></h3>
                <p class="fs-5">Menus</p>
            </div>
            <i
                class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>

    <div class="col-md-3" style="text-align:center;">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2"><?php echo e($plato); ?></h3>
                <p class="fs-5">Platos</p>
            </div>
            <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>

    <div class="col-md-3" style="text-align:center;">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2"><?php echo e($users_cont); ?></h3>
                <p class="fs-5">Usuarios</p>
            </div>
            <i class="fas fa-chart-line fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>
</div>
</div>


<div class="row my-5">

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

    <h3 class="fs-4 mb-3">Usuarios</h3>

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
                    <th scope="col">email</th>
                    <th scope="col">password</th>
                    <th scope="col">nombre</th>
                    <th scope="col">apellido</th>
                    <th scope="col">telefono</th>
                    <th scope="col">direccion</th>
                    <th scope="col">pais</th>
                    <th scope="col">provincia</th>
                    <th scope="col">poblacion</th>
                    <th scope="col">cod_postal</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <th><?php echo e($item->id); ?></th>
                    <td><?php echo e($item->email); ?></td>
                    <td><?php echo e($item->password); ?></td>
                    <td><?php echo e($item->name); ?></td>
                    <td><?php echo e($item->apellido); ?></td>
                    <td><?php echo e($item->telefono); ?></td>
                    <td><?php echo e($item->direccion); ?></td>
                    <td><?php echo e($item->pais); ?></td>
                    <td><?php echo e($item->provincia); ?></td>
                    <td><?php echo e($item->poblacion); ?></td>
                    <td><?php echo e($item->cod_postal); ?></td>
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
                                        <label for="exampleInputPassword1">Apellido</label>
                                        <input type="text" name="apellido" class="form-control" id="exampleInputPassword1" placeholder="" value=<?php echo e($item->apellido); ?> >
                                      </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Contraseña</label>
                                      <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="" >
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6"><label class="labels">Telefono</label><input type="text" class="form-control" name="telefono" value=<?php echo e($item->telefono); ?>></div>
                                        <div class="col-md-6"><label class="labels">Dirección</label><input type="text" class="form-control" name="direccion" value=<?php echo e($item->direccion); ?>></div>
                                        <div class="col-md-6"><label class="labels">Pais</label><input type="text" class="form-control" name="pais" value=<?php echo e($item->pais); ?>></div>
                                        <div class="col-md-6"><label class="labels">Provincia</label><input type="text" class="form-control" name="provincia" value=<?php echo e($item->provincia); ?> ></div>
                                        <div class="col-md-6"><label class="labels">Población</label><input type="text" class="form-control" name="poblacion" value=<?php echo e($item->poblacion); ?> ></div>
                                        <div class="col-md-6"><label class="labels">Código postal</label><input type="text" class="form-control" name="cod_postal" value=<?php echo e($item->cod_postal); ?>></div>
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
<?php /**PATH /home/vadym/Escritorio/DSS/dss/resources/views/panel_admin.blade.php ENDPATH**/ ?>