<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <title>Panel de usuario</title>

    <style>
        :root {
        --main-bg-color: #c1efde;
        --main-text-color: #009d63;
        --second-text-color: #bbbec5;
        --second-bg-color: #c1efde;
        --icon-fill: #009d63;
        }
        .primary-text {color: var(--main-text-color);}
        .icon-fill {color: var(--icon-fill);}

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

        .styleiconos{
            width: 30px;
            height: 30px;
            background-size: 75% 75%;
            background-repeat: no-repeat;
            color: white;
            text-align:center;
            background-position-x: center;
            background-position-y: center;
        }

        .stylemain{
            width: 30px;
            height: 30px;
            padding: 16px;
            background-size: 75% 75%;
            text-align:center;
            background-position-x: center;
            background-position-y: center;
            background-repeat: no-repeat;
        }     

       .icon-basura{background-image: url('/icons/icon-basura.svg');}
       .icon-editar{background-image: url('/icons/icon-editar.svg');}
       .icon-main{background-image: url('/icons/icon-main.svg');}

</style>

  

</head>

<body>

    <div class="d-flex" id="wrapper">
    <!--░█▀▀▀█ ─▀─ █▀▀▄ █▀▀ ░█▀▀█ █▀▀█ █▀▀█ 
        ─▀▀▀▄▄ ▀█▀ █──█ █▀▀ ░█▀▀▄ █▄▄█ █▄▄▀ 
        ░█▄▄▄█ ▀▀▀ ▀▀▀─ ▀▀▀ ░█▄▄█ ▀  ▀ ▀ ▀▀-->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold border-bottom"><i
                    class="stylemain icon-main"></i><a href="/"class=" text-success">FudRater</a></div>
            <div class="list-group list-group-flush my-3">
                

                <a href="/panelusuario/perfil" id="btn_perfil" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-tachometer-alt me-2"></i>Perfil</a>

                <a href="{{route("MisRestaurantesController.mostrar",auth()->user()->id)}}" id="btn_restaurantes" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Mis restaurantes</a>

                <a href="{{route("ResenyasController.mostrar",auth()->user()->id)}}" id="btn_resenya" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Mis reseñas</a>

                <a href="/panelusuario/admin" id="btn_admin" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-project-diagram me-2"></i>Admin</a>
                <a href="/logout" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>


        <!--█▄░█ ▄▀█ █░█ █▄▄ ▄▀█ █▀█
            █░▀█ █▀█ ▀▄▀ █▄█ █▀█ █▀▄-->
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

            <!--
            █ █▄░█ █▀▀ █░░ █░█ █▀▄ █▀▀ █▀
            █ █░▀█ █▄▄ █▄▄ █▄█ █▄▀ ██▄ ▄█-->

        
            @include('panel_usuario.admin.panel_admin_contador')

            @if (@isset($errors) && count($errors) > 0)

            <div class="alert alert-danger">
                <ul class="list-unstyled mb-0">
                    @foreach ($errors->all() as $error)
                        <li> {{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            @include('panel_usuario.admin.panel_admin_restaurante')
            @include('panel_usuario.admin.panel_admin_menu')
            @include('panel_usuario.admin.panel_admin_plato')
            
            @include('panel_usuario.admin.panel_admin_valoraciones')

            @include('panel_usuario.admin.panel_admin_users')


        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>
