
<div class="row my-5">

    @if (session("correcto"))
        <div class="alert alert-success">{{session("correcto")}}</div>
    @endif
    @if (session("incorrecto"))
    <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <script>
        var res=function($id){
            var not=confirm("¿Eliminar la valoración '" + $id + "' ?");
            return not;
        }
    </script>

    <div class="text-center">
        <h3 class="fs-4 mb-3">Valoraciones</h3>
    </div>

    <div class="p-5 table-responsive">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearValoracion">Crear valoración</button>

        <!-- █▀▀ █▀█ █▀▀ ▄▀█ █▀█   █░█ ▄▀█ █░░ █▀█ █▀█ ▄▀█ █▀▀ █ █▀█ █▄░█
             █▄▄ █▀▄ ██▄ █▀█ █▀▄   ▀▄▀ █▀█ █▄▄ █▄█ █▀▄ █▀█ █▄▄ █ █▄█ █░▀█-->
        <div class="modal fade" id="modalCrearValoracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear valoración</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{route("AdminController.crear")}}" method="POST">
                        @csrf
                        <!--Para identificar la tabla -->
                        <input type="text" name="tabla" value="valoracion" style="display:none" readonly>

                        <div class="form-group">
                            <label for="exampleInputPassword1">puntuacion (obligatorio)</label>
                            <input type="text" name="puntuacion" class="form-control" id="exampleInputPassword1" placeholder="" required>
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">comentario</label>
                          <input type="text" name="comentario" class="form-control" id="exampleInputEmail1" placeholder="" >
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">users_id (obligatorio)</label>
                          <input type="text" name="users_id" class="form-control" id="exampleInputPassword1" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">menu_id (obligatorio)</label>
                            <input type="text" name="menu_id" class="form-control" id="exampleInputPassword1" placeholder="" required>
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

        <!--█▄▄ █░█ █▀ █▀▀ ▄▀█ █▀█   █░█ ▄▀█ █░░ █▀█ █▀█ ▄▀█ █▀▀ █ █▀█ █▄░█
            █▄█ █▄█ ▄█ █▄▄ █▀█ █▀▄   ▀▄▀ █▀█ █▄▄ █▄█ █▀▄ █▀█ █▄▄ █ █▄█ █░▀█ -->
        <form action="{{ route('AdminController.buscar') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="tabla" value="valoracion" style="display:none" readonly><!--Para identificar la tabla -->
                <input type="text" name="busqueda-valoracion" class="form-control" placeholder="Buscar valoraciónes" aria-label="Buscar valoraciónes">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </form>

        <!-- La idea del if-else y luego sacar la tabla en el array es que los resultados de la búsuqeda se muestren
        en una tabla arriba de la tabla de todos los usuarios-->
        @if(session('search-valoracion') && session('search-valoracion') != NULL)
            <p>Resultados de la búsqueda:</p>
            @php
                $arr = [session('search-valoracion'), $valoraciones];
            @endphp
        @else
            <!--Para el ordenado según columna-->
            @if (session('sort-valoraciones') && session('sort-valoraciones') != NULL)
                <p>Resultado de la ordenación por la columna seleccionada:</p>
                @php $arr = [session('sort-valoraciones')]; @endphp
            @else
                @php $arr = [$valoraciones];@endphp    
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
            <!--
            █▀ █▀█ █▀█ ▀█▀
            ▄█ █▄█ █▀▄ ░█░ -->
                <thead>
                    <tr>
                        <th scope="col" width="50"><a href="{{route("AdminController.sort", 'valoraciones-id')}}">#</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'valoraciones-puntuacion')}}">puntuacion</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'valoraciones-comentario')}}">comentario</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'valoraciones-users_id')}}">users_id</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'valoraciones-menu_id')}}">menu_id</a></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    @foreach ($arr[$i] as $item)

                    <tr>
                        <th>{{$item->id}}</th>
                        <td>{{$item->puntuacion}}</td> 
                        <td>{{$item->comentario}}</td>
                        <td>{{$item->users_id}}</td>
                        <td>{{$item->menu_id}}</td>
                        <td> <!--
                            █▀▀ █░░ █ █▀▄▀█ █ █▄░█ ▄▀█ █▀█   █░█ ▄▀█ █░░ █▀█ █▀█ ▄▀█ █▀▀ █ █▀█ █▄░█
                            ██▄ █▄▄ █ █░▀░█ █ █░▀█ █▀█ █▀▄   ▀▄▀ █▀█ █▄▄ █▄█ █▀▄ █▀█ █▄▄ █ █▄█ █░▀█ -->
                            <a href=""  data-bs-toggle="modal" data-bs-target="#modalEditarValoracion{{$item->id}}" class="btn btn-warning btn-sm styleiconos icon-editar"></a>
                            <a href="{{route('AdminController.delValoracion', $item->id)}}" onclick="return res('{{$item->id}}')" class="btn btn-danger btn-sm styleiconos icon-basura"></a>
                        </td>
                        <!--
                        █▀▄▀█ █▀█ █▀▄ █ █▀▀ █ █▀▀ ▄▀█ █▀█   █░█ ▄▀█ █░░ █▀█ █▀█ ▄▀█ █▀▀ █ █▀█ █▄░█ █▀▀ █▀
                        █░▀░█ █▄█ █▄▀ █ █▀░ █ █▄▄ █▀█ █▀▄   ▀▄▀ █▀█ █▄▄ █▄█ █▀▄ █▀█ █▄▄ █ █▄█ █░▀█ ██▄ ▄█-->
                        <!-- Modal de modificar datos de la tabla-->
                        <div class="modal fade" id="modalEditarValoracion{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modificar valoración</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{route("AdminController.mod")}}" method="POST">
                                        @csrf
                                        <!--Para identificar la tabla -->
                                        <input type="text" name="tabla" value="valoracion" style="display:none" readonly>
                                        
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">id</label>
                                            <input type="text" name="id" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$item->id}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">puntuacion</label>
                                            <input type="text" name="puntuacion" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$item->puntuacion}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">comentario</label>
                                            <input type="text" name="comentario" class="form-control" id="exampleInputPassword1" placeholder="" value="{{$item->comentario}}">
                                        </div>
                                        <div class="form-group">
                                        <label for="exampleInputEmail1">menu_id</label>
                                        <input type="text" name="menu_id" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$item->menu_id}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">users_id</label>
                                            <input type="text" name="users_id" class="form-control" id="exampleInputPassword1" placeholder="" value="{{$item->users_id}}" required>
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
            {{ $valoraciones->links() }} <!-- Para mostrar el tab con las paginas del PAGINATION -->
        </div>

    </div>
</div>
