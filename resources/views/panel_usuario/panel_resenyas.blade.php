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
        .iconos {
            display: inline-block;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-size:75% 75%;
            background-position: center;
            background-repeat: no-repeat;
            background-clip: padding-box;
            text-align:center;
            background-position-x: center;
            background-position-y: center;
            
            }

        .stylemain{
            background-size: 75% 75%;
            text-align:center;
            background-position-x: center;
            background-position-y: center;
            background-repeat: no-repeat;
            width: 30px;
            height: 30px;
            padding: 16px;
        }

        .icon-main{background-image: url('/icons/icon-main.svg');}
        .icon-comentarios{background-image: url('/icons/icon-comentarios.svg');}

    </style>

    <script>
        var res=function($nombre){
            var not=confirm("¿Eliminar la reseña del '" + $nombre + "' ?");
            return not;
        }
    </script>

</head>

<body>

    <div class="d-flex" id="wrapper">

    <!--
        █▀ █ █▀▄ █▀▀ █▄▄ ▄▀█ █▀█
        ▄█ █ █▄▀ ██▄ █▄█ █▀█ █▀▄-->
    <div class="bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold border-bottom"><i
                class="stylemain icon-main"></i><a href="/"class=" text-success">FudRater</a></div>
        <div class="list-group list-group-flush my-3">


            <a href="/panelusuario/perfil" id="btn_perfil" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                    class="fas fa-tachometer-alt me-2"></i>Perfil</a>

            <a href="{{route("MisRestaurantesController.mostrar",auth()->user()->id)}}" id="btn_restaurantes" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                    class="fas fa-project-diagram me-2"></i>Mis restaurantes</a>

            <a href="{{route("ResenyasController.mostrar",auth()->user()->id)}}" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                    class="fas fa-project-diagram me-2"></i>Mis reseñas</a>

            <a href="/panelusuario/admin" id="btn_admin" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                    class="fas fa-project-diagram me-2"></i>Admin</a>
            <a href="/logout" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                    class="fas fa-power-off me-2"></i>Logout</a>
        </div>
    </div>

        <!-- Page Content -->
    <div id="page-content-wrapper">

            <!--█▄░█ ▄▀█ █░█ █▄▄ ▄▀█ █▀█
                █░▀█ █▀█ ▀▄▀ █▄█ █▀█ █▀▄-->
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
   
        <!-- █▀▀ █▀█ █▄░█ ▀█▀ ▄▀█ █▀▄ █▀█ █▀█   █▀█ █▀▀ █▀ █▀▀ █▄░█ ▄▀█ █▀
             █▄▄ █▄█ █░▀█ ░█░ █▀█ █▄▀ █▄█ █▀▄   █▀▄ ██▄ ▄█ ██▄ █░▀█ █▀█ ▄█ -->
        <div class="col-md-3 " style="margin: 0 auto; text-align:center;">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2">{{$mis_resenyas_cont}}</h3>
                    <p class="fs-5">Reseñas</p>
                </div>
                <div class="primary-text secondary-bg iconos icon-comentarios" ></div>
            </div>
        </div>

        <!--█▀▀ ▀█▀ █ █▀█ █░█ █▀▀ ▀█▀ ▄▀█ █▀
            ██▄ ░█░ █ ▀▀█ █▄█ ██▄ ░█░ █▀█ ▄█ -->
        <div class="p-5 table-responsive">

            <!--█████ ＢＡＲＲＡ ＤＥ ＢＵＳＣＡＲ █████-->
            <form action="{{ route('AdminController.buscar') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="tabla" value="users" style="display:none" readonly><!--Para identificar la tabla -->
                    <input type="text" name="busqueda-users" class="form-control" placeholder="Buscar reseñas" aria-label="Buscar reseñas">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>
            </form>

            @if (session("correcto"))
            <div class="aler alert-success text-center">{{session("correcto")}}</div>
            @endif
            @if (session("incorrecto"))
            <div class="aler alert-danger text-center">{{session("incorrecto")}}</div>
            @endif

            @if(session('search-resenyas') && session('search-resenyas') != NULL)
                <p>Resultados de la búsqueda:</p>
                @php $arr = [session('search-resenyas'), $mis_resenyas]; @endphp
            @else
                @php $arr = [$mis_resenyas];@endphp    
            @endif

            <!--█████ ＢＵＣＬＥ █████-->
            @for ($i = 0; $i < count($arr); $i++)

                <div class="container">
                    <div class="row">
                        @foreach ($arr[$i] as $item)

                            <div class="col-lg-4 mb-3">
                                <div class="card border-danger">
                                    <div class="d-flex p-3 just-content-start align-items-center">
                                        <img src="https://cdn.pixabay.com/photo/2016/11/18/14/05/brick-wall-1834784_960_720.jpg" alt="" class="mr-4">

                                        <div class="name-job-review">
                                            <p class="font-weight-bold mb-0"> {{$item->menu_nombre}}</p>
                                            <p class="text-muted mb-0">{{$item->dir}}</p>

                                            <ul class="list-inline text-center m-0">
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $item->puntuacion)
                                                        <li class="list-inline-item"> <i class="fas fa-star"></i></li>
                                                    @else
                                                        <li class="list-inline-item"> <i class="fa-regular fa-star"></i></li>      
                                                    @endif
                                                @endfor
                                             </ul>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <blockquote class="blockquote">
                                            <p class="mb-0 " style="font-size: 17px"> <i class="fas fa-quote-left text-danger fw-bold"></i> {{$item->comentario}}</p>
                                        </blockquote>
                                    </div>
                                    <a href=""  data-bs-toggle="modal" data-bs-target="#modalEditarReseña{{$item->id}}" class="btn btn-primary fw-bold"> Editar</a>
                                    <a href="{{route("ResenyasController.delResenya",$item->id)}}" onclick="return res('{{$item->menu_nombre}}')"  class="btn btn-danger btn-sm"> Eliminar</a>

                                    <!--█▀▄▀█ █▀█ █▀▄ █ █▀▀ █ █▀▀ ▄▀█ █▀█   █▀█ █▀▀ █▀ █▀▀ █▄░█ ▄▀█
                                        █░▀░█ █▄█ █▄▀ █ █▀░ █ █▄▄ █▀█ █▀▄   █▀▄ ██▄ ▄█ ██▄ █░▀█ █▀█-->
                                    <div class="modal fade" id="modalEditarReseña{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modificar reseña</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route("ResenyasController.mod")}}" method="POST">
                                                    @csrf
                                                    <input type="text" name="id" value="{{$item->id}}" style="display:none" readonly>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Menu</label>
                                                        <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$item->menu_nombre}}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="exampleInputEmail1">Puntuación (1 a 5)</label>
                                                    <input type="text" name="puntuacion" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$item->puntuacion}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Comentario</label>
                                                        <input type="text" name="comentario" class="form-control" id="exampleInputPassword1" placeholder="" value="{{$item->comentario}}" required>
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
                            </div>
        
                        @endforeach
                    </div>
                </div>

            @endfor   

        </div>


        </div>
    </div>
    <!-- /#page-content-wrapper -->
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
