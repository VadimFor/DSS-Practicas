<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Panel de usuario</title>

    <style>
        :root {
        --main-bg-color: #009d63;
        --main-text-color: #009d63;
        --second-text-color: #bbbec5;
        --second-bg-color: #c1efde;
        }
        .primary-text {color: var(--main-text-color);}
        .second-text {color: var(--second-text-color);}
        .primary-bg {background-color: var(--main-bg-color);}
        .secondary-bg {background-color: var(--second-bg-color);}
        .rounded-full { border-radius: 100%;}

        #wrapper {
            overflow-x: hidden;
            background-image: linear-gradient(
            to right,
            #baf3d7,
            #c2f5de,
            #cbf7e4,
            #d4f8ea,
            #ddfaef
            );
        }

        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            -webkit-transition: margin 0.25s ease-out;
            -moz-transition: margin 0.25s ease-out;
            -o-transition: margin 0.25s ease-out;
            transition: margin 0.25s ease-out;
        }

        #sidebar-wrapper .sidebar-heading {padding: 0.875rem 1.25rem;font-size: 1.2rem;}
        #sidebar-wrapper .list-group {width: 15rem;}
        #page-content-wrapper {min-width: 100vw;}
        #wrapper.toggled #sidebar-wrapper {margin-left: 0;}
        #menu-toggle {cursor: pointer;}
        .list-group-item {border: none;padding: 20px 30px;}
        .list-group-item.active {
            background-color: transparent;
            color: var(--main-text-color);
            font-weight: bold;
            border: none;
        }

        @media (min-width: 768px) {
            #sidebar-wrapper {margin-left: 0;}
            #page-content-wrapper {min-width: 0;width: 100%;}
            #wrapper.toggled #sidebar-wrapper {margin-left: -15rem;}
        }

        img{
            height: 5rem;
            width: 5rem;
            border-radius: 75%;
        }

        .fa-star, .fa-star-half-alt{
            color: #ffbf00;
        }

        .fa-quote-left{
            font-size: 1rem;
        }

    </style>

    <script src="https://kit.fontawesome.com/646ac4fad6.js" crossorigin="anonymous"></script>


    <script>
        var res=function($nombre){
            var not=confirm("¿Eliminar al restaurante '" + $nombre + "' ?");
            return not;
        }
    </script>

</head>

<body>


    <div class="d-flex" id="wrapper">

    <!--░█▀▀▀█ ─▀─ █▀▀▄ █▀▀ ░█▀▀█ █▀▀█ █▀▀█ 
        ─▀▀▀▄▄ ▀█▀ █──█ █▀▀ ░█▀▀▄ █▄▄█ █▄▄▀ 
        ░█▄▄▄█ ▀▀▀ ▀▀▀─ ▀▀▀ ░█▄▄█ ▀  ▀ ▀ ▀▀-->
    <div class="bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold border-bottom"><i
                class="bx bx-bowl-hot"></i><a href="/"class=" text-success">FudRater</a></div>
        <div class="list-group list-group-flush my-3">


            <a href="/panelusuario/perfil" id="btn_perfil" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                    class="fas fa-tachometer-alt me-2"></i>Perfil</a>

            <a href="{{route("MisRestaurantesController.mostrar",auth()->user()->id)}}" id="btn_restaurantes" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                    class="fas fa-project-diagram me-2"></i>Mis restaurantes</a>

            <a href="/panelusuario/resenyas" id="btn_resenya" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                    class="fas fa-project-diagram me-2"></i>Mis reseñas</a>

            <a href="/panelusuario/admin" id="btn_admin" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                    class="fas fa-project-diagram me-2"></i>Admin</a>


            <a href="/logout" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                    class="fas fa-power-off me-2"></i>Logout</a>
        </div>
    </div>

        <!-- ░█▄─░█ █▀▀█ ▀█─█▀ ░█▀▀█ █▀▀█ █▀▀█ 
             ░█░█░█ █▄▄█ ─█▄█─ ░█▀▀▄ █▄▄█ █▄▄▀ 
             ░█──▀█ ▀──▀ ──▀── ░█▄▄█ ▀──▀ ▀─▀▀ -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Panel de usuario</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>{{auth()->user()->email ?? auth()->user()->email}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Perfil</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        <div class="col-md-3 " style="margin: 0 auto; text-align:center;">


        <!-- ＣＯＮＴＡＤＯＲ ＤＥ ＭＩＳ ＲＥＳＴＡＵＲＡＮＴＥＳ -->
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">{{$mis_restaurantes_cont}}</h3>
                <p class="fs-5">Restaurantes</p>
            </div>
            <i class="fas fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>


    @if (session("correcto"))
        <div class="alert alert-success">{{session("correcto")}}</div>
    @endif
    @if (session("incorrecto"))
    <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <!--▒█▀▀█ █▀▀█ █▀▀ █▀▀█ █▀▀█ 　 █▀▀█ █▀▀ █▀▀ ▀▀█▀▀ █▀▀█ █░░█ █▀▀█ █▀▀█ █▀▀▄ ▀▀█▀▀ █▀▀ 
        ▒█░░░ █▄▄▀ █▀▀ █▄▄█ █▄▄▀ 　 █▄▄▀ █▀▀ ▀▀█ ░░█░░ █▄▄█ █░░█ █▄▄▀ █▄▄█ █░░█ ░░█░░ █▀▀ 
        ▒█▄▄█ ▀░▀▀ ▀▀▀ ▀░░▀ ▀░▀▀ 　 ▀░▀▀ ▀▀▀ ▀▀▀ ░░▀░░ ▀░░▀ ░▀▀▀ ▀░▀▀ ▀░░▀ ▀░░▀ ░░▀░░ ▀▀▀ -->
        <!-- Page Content -->
    <div id="page-content-wrapper">

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
                    <form action="{{route("MisRestaurantesController.crear")}}" method="POST">
                        @csrf
                        <!--Para identificar el usuario -->
                        <input type="text" name="id" value="{{auth()->user()->id}}" style="display:none" readonly>

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
    </div>
    <!-- 
    ▀▀█▀▀ ─█▀▀█ ░█▀▀█ ░█─── ─█▀▀█ 
    ─░█── ░█▄▄█ ░█▀▀▄ ░█─── ░█▄▄█ 
    ─░█── ░█─░█ ░█▄▄█ ░█▄▄█ ░█─░█
    -->

    <form action="{{ route('MisRestaurantesController.buscar') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="id" value="{{auth()->user()->id}}" style="display:none" readonly>
            <input type="text" name="busqueda-restaurante" class="form-control" placeholder="Buscar restaurante" aria-label="Buscar restaurante">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
        </div>
    </form>

            <!-- La idea del if-else y luego sacar la tabla en el array es que los resultados de la búsuqeda se muestren
    en una tabla arriba de la tabla de todos los usuarios-->
    @if(session('search-restaurante') && session('search-restaurante') != NULL)
        <p>Resultados de la búsqueda:</p>
        @php
            $arr = [session('search-restaurante'), $mis_restaurantes];
        @endphp
    @else
        <!--Para el ordenado según columna-->
        @if (session('sort-restaurantes') && session('sort-restaurantes') != NULL)
            <p>Resultado de la ordenación por la columna seleccionada:</p>
            @php $arr = [session('sort-restaurantes')]; @endphp
        @else
            @php $arr = [$mis_restaurantes];@endphp    
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
                    <th scope="col" width="50"><a href="{{route("MisRestaurantesController.sort", 'id')}}">#</a></th>
                    <th scope="col"><a href="{{route("MisRestaurantesController.sort", 'nombre')}}">nombre</a></th>
                    <th scope="col"><a href="{{route("MisRestaurantesController.sort", 'direccion')}}">direccion</a></th>
                    <th scope="col"><a href="{{route("MisRestaurantesController.sort", 'telefono')}}">telefono</a></th>
                    <th scope="col"><a href="{{route("MisRestaurantesController.sort", 'descripcion')}}">descripcion</a></th>
                    <th scope="col"><a href="{{route("MisRestaurantesController.sort", 'img')}}">img</a></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @foreach ($arr[$i] as $item)   <!--ＦＯＲＥＡＣＨ -->

                <tr>
                    <th>{{$item->id}}</th>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->direccion}}</td>
                    <td>{{$item->telefono}}</td>
                    <td>{{$item->descripcion}}</td>
                    <td>{{$item->img}}</td>
                    <td>
                        <a href=""  data-bs-toggle="modal" data-bs-target="#modalEditarRestaurante{{$item->id}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{route("MisRestaurantesController.delRestaurante",$item->id)}}" onclick="res('{{$item->nombre}}')"  class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
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
                                <!--
                                █▀▄▀█ █▀█ █▀▄ █ █▀▀ █ █▀▀ ▄▀█ █▀█   █▀█ █▀▀ █▀ ▀█▀ ▄▀█ █░█ █▀█ ▄▀█ █▄░█ ▀█▀ █▀▀
                                █░▀░█ █▄█ █▄▀ █ █▀░ █ █▄▄ █▀█ █▀▄   █▀▄ ██▄ ▄█ ░█░ █▀█ █▄█ █▀▄ █▀█ █░▀█ ░█░ ██▄ -->
                                <form action="{{route("MisRestaurantesController.mod")}}" method="POST">
                                    @csrf
                                    <!--Para identificar la tabla -->
                                    <input type="text" name="tabla" value="restaurante" style="display:none" readonly>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">id</label>
                                        <input type="text" name="id" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$item->id}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">nombre</label>
                                        <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$item->nombre}}" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">direccion</label>
                                    <input type="text" name="direccion" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$item->direccion}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">telefono</label>
                                        <input type="text" name="telefono" class="form-control" id="exampleInputPassword1" placeholder="" value="{{$item->telefono}}" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">descripcion</label>
                                    <input type="text" name="descripcion" class="form-control" id="exampleInputPassword1" placeholder="" value="{{$item->descripcion}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">img</label>
                                        <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="" value="{{$item->img}}">
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
        {{ $mis_restaurantes->links() }} <!-- Para mostrar el tab con las paginas del PAGINATION -->
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>
