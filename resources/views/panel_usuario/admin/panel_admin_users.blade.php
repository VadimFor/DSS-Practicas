<div class="row my-5">

    @if (session("correcto"))
        <div class="alert alert-success">{{session("correcto")}}</div>
    @endif
    @if (session("incorrecto"))
    <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <script>
        var res=function($email){
            var not=confirm("¿Eliminar a " + $email + " ?");
            return not;
        }
    </script>


    <div class="text-center">
        <h3 class="fs-4 mb-3">Usuarios</h3>
    </div>

    
    <div class="p-5 table-responsive">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario">Crear usuario</button>

        <!-- 
        █▀▀ █▀█ █▀▀ ▄▀█ █▀█   █░█ █▀ █░█ ▄▀█ █▀█ █ █▀█
        █▄▄ █▀▄ ██▄ █▀█ █▀▄   █▄█ ▄█ █▄█ █▀█ █▀▄ █ █▄█ -->
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
                        <form action="{{route("AdminController.crear")}}" method="POST">
                            @csrf
                            <!--Para identificar la tabla -->
                            <input type="text" name="tabla" value="users" style="display:none" readonly>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Email (obligatorio)</label>
                                <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Nombre </label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Contraseña (obligatorio)</label>
                            <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Verificar contraseña (obligatorio)</label>
                                <input type="text" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="" required>
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
        █▄▄ █░█ █▀ █▀▀ ▄▀█ █▀█   █░█ █▀ █░█ ▄▀█ █▀█ █ █▀█
        █▄█ █▄█ ▄█ █▄▄ █▀█ █▀▄   █▄█ ▄█ █▄█ █▀█ █▀▄ █ █▄█-->
        <form action="{{ route('AdminController.buscar') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="tabla" value="users" style="display:none" readonly><!--Para identificar la tabla -->
                <input type="text" name="busqueda-users" class="form-control" placeholder="Buscar usuarios" aria-label="Buscar usuarios">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </form>


        <!-- La idea del if-else y luego sacar la tabla en el array es que los resultados de la búsuqeda se muestren
        en una tabla arriba de la tabla de todos los usuarios-->
        @if(session('search-users') && session('search-users') != NULL)
            <p>Resultados de la búsqueda:</p>
            @php
                $arr = [session('search-users'), $users];
            @endphp
        @else

            <!--Para el ordenado según columna-->
            @if (session('sort-users') && session('sort-users') != NULL)
                <p>Resultado de la ordenación por la columna seleccionada:</p>
                @php $arr = [session('sort-users')]; @endphp
            @else
                @php $arr = [$users];@endphp    
            @endif

        @endif

        @for ($i = 0; $i < count($arr); $i++)
            
            @if(count($arr) == 2) <!--Si hay 2 tablas, 1 de ella de la búsqueda -->
                @if($i == 0) 
                <table class="table bg-white rounded shadow-sm table-bordered table-hover table-info ">
                @else
                <table class="table bg-white rounded shadow-sm table-bordered table-hover">
                @endif
            @else <!--Si no hay tabla de búsqueda -->
                <table class="table bg-white rounded shadow-sm table-bordered table-hover">
            @endif 

            <!--FORMA ALTERNATIVA CAMBIAR COLOR
                @php $tableClass = 'table bg-white rounded shadow-sm table-bordered table-hover' . (count($arr) == 2 && $i == 0 ? ' table-info' : ''); @endphp
                <table class="{{ $tableClass }}"> 
            -->

                <thead>
                    <tr>
                        <th scope="col" width="50"><a href="{{route("AdminController.sort", 'users-id')}}">#</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'users-email')}}">email</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'users-password')}}">password</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'users-name')}}">nombre</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'users-apellido')}}">apellido</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'users-telefono')}}">telefono</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'users-direccion')}}">direccion</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'users-pais')}}">pais</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'users-provincia')}}">provincia</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'users-poblacion')}}">poblacion</a></th>
                        <th scope="col"><a href="{{route("AdminController.sort", 'users-cod_postal')}}">cod_postal</a></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                   
                    @foreach ($arr[$i] as $item)

                        <tr>
                            <th>{{$item->id}}</th>
                            <td>{{$item->email}}</td>
                            <td>{{$item->password}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->apellido}}</td>
                            <td>{{$item->telefono}}</td>
                            <td>{{$item->direccion}}</td>
                            <td>{{$item->pais}}</td>
                            <td>{{$item->provincia}}</td>
                            <td>{{$item->poblacion}}</td>
                            <td>{{$item->cod_postal}}</td>
                            <td>
                                <!--
                                █▀▀ █░░ █ █▀▄▀█ █ █▄░█ ▄▀█ █▀█   █░█ █▀ █░█ ▄▀█ █▀█ █ █▀█
                                ██▄ █▄▄ █ █░▀░█ █ █░▀█ █▀█ █▀▄   █▄█ ▄█ █▄█ █▀█ █▀▄ █ █▄█-->
                                <a href=""  data-bs-toggle="modal" data-bs-target="#modalEditar{{$item->id}}" class="btn btn-warning btn-sm styleiconos icon-editar"></a>
                                <a href="{{route("AdminController.delUsuario",$item->email)}}" onclick="return res('{{$item->email}}')"  class="btn btn-danger btn-sm styleiconos icon-basura"></a>
                            </td>

                            <div class="modal fade" id="modalEditar{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modificar usuario</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">

                                        <!-- 
                                        █▀▄▀█ █▀█ █▀▄ █ █▀▀ █ █▀▀ ▄▀█ █▀█   █░█ █▀ █░█ ▄▀█ █▀█ █ █▀█
                                        █░▀░█ █▄█ █▄▀ █ █▀░ █ █▄▄ █▀█ █▀▄   █▄█ ▄█ █▄█ █▀█ █▀▄ █ █▄█  -->                                      
                                        <form action="{{route("AdminController.mod")}}" method="POST">
                                            @csrf
                                            <!--Para identificar la tabla -->
                                            <input type="text" name="tabla" value="users" style="display:none" readonly>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">id</label>
                                                <input type="email" name="id" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$item->id}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$item->email}}" readonly>
                                            </div>
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Nombre</label>
                                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$item->name}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Apellido</label>
                                                <input type="text" name="apellido" class="form-control" id="exampleInputPassword1" placeholder="" value="{{$item->apellido}}" >
                                            </div>
                                            <div class="form-group">
                                            <label for="exampleInputPassword1">Contraseña</label>
                                            <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="" >
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6"><label class="labels">Telefono</label><input type="text" class="form-control" name="telefono" value={{$item->telefono}}></div>
                                                <div class="col-md-6"><label class="labels">Dirección</label><input type="text" class="form-control" name="direccion" value={{$item->direccion}}></div>
                                                <div class="col-md-6"><label class="labels">Pais</label><input type="text" class="form-control" name="pais" value={{$item->pais}}></div>
                                                <div class="col-md-6"><label class="labels">Provincia</label><input type="text" class="form-control" name="provincia" value={{$item->provincia}} ></div>
                                                <div class="col-md-6"><label class="labels">Población</label><input type="text" class="form-control" name="poblacion" value={{$item->poblacion}} ></div>
                                                <div class="col-md-6"><label class="labels">Código postal</label><input type="text" class="form-control" name="cod_postal" value={{$item->cod_postal}}></div>
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
            {{ $users->links() }}  <!-- Para mostrar el tab con las paginas del PAGINATION -->
        </div>
    </div>
</div>
