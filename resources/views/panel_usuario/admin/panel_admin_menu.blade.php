<div class="row my-5">

    @if (session("correcto"))
        <div class="alert alert-success">{{session("correcto")}}</div>
    @endif
    @if (session("incorrecto"))
    <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <script>
        var res=function($nombre){
            var not=confirm("¿Eliminar al menú '" + $nombre + "' ?");
            return not;
        }
    </script>

    <h3 class="fs-4 mb-3">Menus</h3>

    <div class="p-5 table-responsive">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearMenu">Crear menu</button>

        <!-- Modal de crear usuario-->
        <div class="modal fade" id="modalCrearMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear menu</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{route("AdminController.crear")}}" method="POST">
                        @csrf
                        <!--Para identificar la tabla -->
                        <input type="text" name="tabla" value="menu" style="display:none" readonly>

                        <div class="form-group">
                            <label for="exampleInputPassword1">nombre (obligatorio)</label>
                            <input type="text" name="nombre" class="form-control" id="exampleInputPassword1" placeholder="" required>
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">descripcion </label>
                          <input type="text" name="descripcion" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">precio (obligatorio)</label>
                          <input type="text" name="precio" class="form-control" id="exampleInputPassword1" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">restaurante_id (obligatorio)</label>
                            <input type="text" name="restaurante_id" class="form-control" id="exampleInputPassword1" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">img</label>
                            <input type="text" name="img" class="form-control" id="exampleInputPassword1" placeholder="">
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
                    <th scope="col">nombre</th>
                    <th scope="col">descripcion</th>
                    <th scope="col">precio</th>
                    <th scope="col">restaurante_id</th>
                    <th scope="col">img</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @foreach ($menus as $item)

                <tr>
                    <th>{{$item->id}}</th>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->descripcion}}</td>
                    <td>{{$item->precio}}</td>
                    <td>{{$item->restaurante_id}}</td>
                    <td>{{$item->img}}</td>

                    <td>
                        <a href=""  data-bs-toggle="modal" data-bs-target="#modalEditarMenu{{$item->id}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{route("AdminController.delMenu",$item->id)}}" onclick="res('{{$item->nombre}}')"  class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                    </td>

                    <!-- Modal de modificar datos de la tabla-->
                    <div class="modal fade" id="modalEditarMenu{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modificar menú</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">

                                <form action="{{route("AdminController.mod")}}" method="POST">
                                    @csrf
                                    <!--Para identificar la tabla -->
                                    <input type="text" name="tabla" value="menu" style="display:none" readonly>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">id</label>
                                        <input type="text" name="id" class="form-control" id="exampleInputEmail1" placeholder="" value={{$item->id}} readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">nombre</label>
                                        <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" placeholder="" value={{$item->nombre}} required>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">descripcion</label>
                                      <input type="text" name="descripcion" class="form-control" id="exampleInputEmail1" placeholder="" value={{$item->descripcion}}>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">precio</label>
                                        <input type="text" name="precio" class="form-control" id="exampleInputPassword1" placeholder="" value={{$item->precio}} required>
                                      </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">restaurante_id</label>
                                      <input type="text" name="restaurante_id" class="form-control" id="exampleInputPassword1" placeholder=""  value={{$item->restaurante_id}} required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">img</label>
                                        <input type="text" name="img" class="form-control" id="exampleInputPassword1" placeholder=""  value={{$item->img}}>
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

                @endforeach

            </tbody>
        </table>


    </div>
</div>