<div class="row my-5">

    @if (session("correcto"))
        <div class="alert alert-success">{{session("correcto")}}</div>
    @endif
    @if (session("incorrecto"))
    <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <script>
        var res=function($nombre){
            var not=confirm("¿Eliminar al plato '" + $nombre + "' ?");
            return not;
        }
    </script>

    <div class="text-center">
        <h3 class="fs-4 mb-3">Platos</h3>
    </div>

    <div class="p-5 table-responsive">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearPlato">Crear plato</button>

        <!-- █▀▀ █▀█ █▀▀ ▄▀█ █▀█   █▀█ █░░ ▄▀█ ▀█▀ █▀█
             █▄▄ █▀▄ ██▄ █▀█ █▀▄   █▀▀ █▄▄ █▀█ ░█░ █▄█-->
        <div class="modal fade" id="modalCrearPlato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear plato</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{route("AdminController.crear")}}" method="POST">
                        @csrf
                        <!--Para identificar la tabla -->
                        <input type="text" name="tabla" value="plato" style="display:none" readonly>

                        <div class="form-group">
                            <label for="exampleInputPassword1">nombre (obligatorio)</label>
                            <input type="text" name="nombre" class="form-control" id="exampleInputPassword1" placeholder="" required>
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">descripcion (obligatorio) </label>
                          <input type="text" name="descripcion" class="form-control" id="exampleInputEmail1" placeholder="" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">menu_id (obligatorio)</label>
                          <input type="text" name="menu_id" class="form-control" id="exampleInputPassword1" placeholder="" required>
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
        <!--
        █▄▄ █░█ █▀ █▀▀ ▄▀█ █▀█   █▀█ █░░ ▄▀█ ▀█▀ █▀█
        █▄█ █▄█ ▄█ █▄▄ █▀█ █▀▄   █▀▀ █▄▄ █▀█ ░█░ █▄█-->
        <form action="{{ route('AdminController.buscar') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="tabla" value="plato" style="display:none" readonly><!--Para identificar la tabla -->
                <input type="text" name="busqueda-plato" class="form-control" placeholder="Buscar platos" aria-label="Buscar platos">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </form>

        <!-- La idea del if-else y luego sacar la tabla en el array es que los resultados de la búsuqeda se muestren
        en una tabla arriba de la tabla de todos los usuarios-->
        @if(session('search-plato') && session('search-plato') != NULL)
            <p>Resultados de la búsqueda:</p>
            @php
                $arr = [session('search-plato'), $platos];
            @endphp
        @else
            <!--Para el ordenado según columna-->
            @if (session('sort-platos') && session('sort-platos') != NULL)
                <p>Resultado de la ordenación por la columna seleccionada:</p>
                @php $arr = [session('sort-platos')]; @endphp
            @else
                @php $arr = [$platos];@endphp    
            @endif
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
                        <th scope="col" width="50"><a href="{{route("AdminController.sort", 'platos-id')}}">#</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'platos-nombre')}}">nombre</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'platos-descripcion')}}">descripcion</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'platos-menu_id')}}">menu_id</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'platos-img')}}">img</a></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    @foreach ($arr[$i] as $item)

                    <tr>
                        <th>{{$item->id}}</th>
                        <td>{{$item->nombre}}</td>
                        <td>{{$item->descripcion}}</td>
                        <td>{{$item->menu_id}}</td>
                        <td>{{$item->img}}</td>
                        <td> <!--
                            █▀▀ █░░ █ █▀▄▀█ █ █▄░█ ▄▀█ █▀█   █▀█ █░░ ▄▀█ ▀█▀ █▀█
                            ██▄ █▄▄ █ █░▀░█ █ █░▀█ █▀█ █▀▄   █▀▀ █▄▄ █▀█ ░█░ █▄█-->
                            <a href=""  data-bs-toggle="modal" data-bs-target="#modalEditarPlato{{$item->id}}" class="btn btn-warning btn-sm styleiconos icon-editar"></a>
                            <a href="{{route("AdminController.delPlato",$item->id)}}" onclick="return res('{{$item->nombre}}')"  class="btn btn-danger btn-sm styleiconos icon-basura"></a>
                        </td>
                        
                        <!-- Modal de modificar datos de la tabla-->
                        <div class="modal fade" id="modalEditarPlato{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modificar plato</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <!--
                                    █▀▄▀█ █▀█ █▀▄ █ █▀▀ █ █▀▀ ▄▀█ █▀█   █▀█ █░░ ▄▀█ ▀█▀ █▀█
                                    █░▀░█ █▄█ █▄▀ █ █▀░ █ █▄▄ █▀█ █▀▄   █▀▀ █▄▄ █▀█ ░█░ █▄█-->
                                    <form action="{{route("AdminController.mod")}}" method="POST">
                                        @csrf
                                        <!--Para identificar la tabla -->
                                        <input type="text" name="tabla" value="plato" style="display:none" readonly>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">id</label>
                                            <input type="text" name="id" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$item->id}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">nombre</label>
                                            <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$item->nombre}}" required >
                                        </div>
                                        <div class="form-group">
                                        <label for="exampleInputEmail1">descripcion</label>
                                        <input type="text" name="descripcion" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$item->descripcion}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">menu_id</label>
                                            <input type="text" name="menu_id" class="form-control" id="exampleInputPassword1" placeholder="" value="{{$item->menu_id}}" required>
                                        </div>
                                        <div class="form-group">
                                        <label for="exampleInputPassword1">img</label>
                                        <input type="text" name="img" class="form-control" id="exampleInputPassword1" placeholder=""  value="{{$item->img}}">
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
            {{ $platos->links() }} <!-- Para mostrar el tab con las paginas del PAGINATION -->
        </div>


    </div>
</div>
