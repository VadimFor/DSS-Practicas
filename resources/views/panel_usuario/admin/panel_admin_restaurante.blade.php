<div class="row my-5">

    @if (session("correcto"))
        <div class="alert alert-success">{{session("correcto")}}</div>
    @endif
    @if (session("incorrecto"))
    <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <script>
        var res=function($nombre){
            var not=confirm("¿Eliminar al restaurante '" + $nombre + "' ?");
            return not;
        }
    </script>

    <h3 class="fs-4 mb-3">Restaurantes</h3>

    <div class="p-5 table-responsive">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearRestaurante">Crear restaurante</button>

        <!-- Modal de crear usuario-->
        <div class="modal fade" id="modalCrearRestaurante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear restaurante</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{route("AdminController.crear")}}" method="POST">
                        @csrf
                        <!--Para identificar la tabla -->
                        <input type="text" name="tabla" value="restaurante" style="display:none" readonly>

                        <div class="form-group">
                            <label for="exampleInputPassword1">nombre (obligatorio)</label>
                            <input type="text" name="nombre" class="form-control" id="exampleInputPassword1" placeholder="" required>
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">direccion (obligatorio)</label>
                          <input type="text" name="direccion" class="form-control" id="exampleInputEmail1" placeholder="" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">telefono (obligatorio)</label>
                          <input type="text" name="telefono" class="form-control" id="exampleInputPassword1" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">descripcion (obligatorio)</label>
                            <input type="text" name="descripcion" class="form-control" id="exampleInputPassword1" placeholder="" required>
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

        <!-- 
        ▀▀█▀▀ ─█▀▀█ ░█▀▀█ ░█─── ─█▀▀█ 
        ─░█── ░█▄▄█ ░█▀▀▄ ░█─── ░█▄▄█ 
        ─░█── ░█─░█ ░█▄▄█ ░█▄▄█ ░█─░█
        -->

        <form action="{{ route('AdminController.buscar') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="tabla" value="restaurante" style="display:none" readonly><!--Para identificar la tabla -->
                <input type="text" name="busqueda-restaurante" class="form-control" placeholder="Buscar restaurante" aria-label="Buscar restaurante">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </form>

                <!-- La idea del if-else y luego sacar la tabla en el array es que los resultados de la búsuqeda se muestren
        en una tabla arriba de la tabla de todos los usuarios-->
        @if(session('search-restaurante') && session('search-restaurante') != NULL)
            <p>Resultados de la búsqueda:</p>
            @php
                $arr = [session('search-restaurante'), $restaurantes];
            @endphp
        @else
            @php 
                $arr = [$restaurantes];
            @endphp
        @endif

        @for ($i = 0; $i < count($arr); $i++)

            <!-- CAMBIAR COLOR DE LA TABLA DE BÚSQUEDAS-->
            @if(count($arr) == 2)
                @if($i == 0) 
                <table class="table bg-white rounded shadow-sm table-bordered table-hover table-info ">
                @else
                <table class="table bg-white rounded shadow-sm table-bordered table-hover">
                @endif
            @else
                <table class="table bg-white rounded shadow-sm table-bordered table-hover">
            @endif

                <thead>
                    <tr>
                        <th scope="col" width="50">#</th>
                        <th scope="col">nombre</th>
                        <th scope="col">direccion</th>
                        <th scope="col">telefono</th>
                        <th scope="col">descripcion</th>
                        <th scope="col">img</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    @foreach ($arr[$i] as $item)

                    <tr>
                        <th>{{$item->id}}</th>
                        <td>{{$item->nombre}}</td>
                        <td>{{$item->direccion}}</td>
                        <td>{{$item->telefono}}</td>
                        <td>{{$item->descripcion}}</td>
                        <td>{{$item->img}}</td>
                        <td>
                            <a href=""  data-bs-toggle="modal" data-bs-target="#modalEditarRestaurante{{$item->id}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{route("AdminController.delRestaurante",$item->id)}}" onclick="res('{{$item->nombre}}')"  class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                        </td>

                        <!-- Modal de modificar datos de la tabla-->
                        <div class="modal fade" id="modalEditarRestaurante{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modificar restaurante</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{route("AdminController.mod")}}" method="POST">
                                        @csrf
                                        <!--Para identificar la tabla -->
                                        <input type="text" name="tabla" value="restaurante" style="display:none" readonly>
                                        
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">id</label>
                                            <input type="text" name="id" class="form-control" id="exampleInputEmail1" placeholder="" value={{$item->id}} readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">nombre</label>
                                            <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" placeholder="" value={{$item->nombre}} required>
                                        </div>
                                        <div class="form-group">
                                        <label for="exampleInputEmail1">direccion</label>
                                        <input type="text" name="direccion" class="form-control" id="exampleInputEmail1" placeholder="" value={{$item->direccion}} required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">telefono</label>
                                            <input type="text" name="telefono" class="form-control" id="exampleInputPassword1" placeholder="" value={{$item->telefono}} required>
                                        </div>
                                        <div class="form-group">
                                        <label for="exampleInputPassword1">descripcion</label>
                                        <input type="text" name="descripcion" class="form-control" id="exampleInputPassword1" placeholder="" value={{$item->descripcion}} required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">img</label>
                                            <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="" value={{$item->img}}>
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
        @endfor

        <div style="display: flex; justify-content: center;">
            {{ $restaurantes->links() }} <!-- Para mostrar el tab con las paginas del PAGINATION -->
        </div>

    </div>
</div>
