


<div class="container rounded bg-white mt-1 mb-1">

    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                <span class="font-weight-bold"><?php echo e(auth()->user()->name); ?> <?php echo e(auth()->user()->apellido); ?></span>
                <span class="text-black-50"><?php echo e(auth()->user()->email); ?></span>
                <span> </span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <form action="<?php echo e(route("home.modperfil")); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input name="email" value=<?php echo e(auth()->user()->email); ?> type="hidden">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Perfil</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Nombre</label><input type="text" name="name" class="form-control"  value=<?php echo e(auth()->user()->name); ?>></div>
                        <div class="col-md-6"><label class="labels">Apellido</label><input type="text" class="form-control" name="apellido" value=<?php echo e(auth()->user()->apellido); ?> ></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Teléfono</label><input type="text" class="form-control" name="telefono" value=<?php echo e(auth()->user()->telefono); ?>></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Dirección</label><input type="text" class="form-control" name="direccion" value=<?php echo e(auth()->user()->direccion); ?>></div>
                        <div class="col-md-6"><label class="labels">Pais</label><input type="text" class="form-control" name="pais" value=<?php echo e(auth()->user()->pais); ?>></div>
                        <div class="col-md-6"><label class="labels">Provincia</label><input type="text" class="form-control" name="provincia" value=<?php echo e(auth()->user()->provincia); ?> ></div>
                        <div class="col-md-6"><label class="labels">Población</label><input type="text" class="form-control" name="poblacion" value=<?php echo e(auth()->user()->poblacion); ?> ></div>
                        <div class="col-md-6"><label class="labels">Código postal</label><input type="text" class="form-control" name="cod_postal" value=<?php echo e(auth()->user()->cod_postal); ?>></div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Guardar</button>
                    </div>
                    <?php if(session("correcto")): ?>
                    <div class="aler alert-success text-center"><?php echo e(session("correcto")); ?></div>
                    <?php endif; ?>
                    <?php if(session("incorrecto")): ?>
                    <div class="aler alert-danger text-center"><?php echo e(session("incorrecto")); ?></div>
                    <?php endif; ?>

                </form>
            </div>

        </div>

    </div>
</div>
<?php /**PATH /home/vadym/Escritorio/DSS/dss/resources/views/panel_perfil.blade.php ENDPATH**/ ?>