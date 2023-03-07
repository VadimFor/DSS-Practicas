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

    </style>

    <script src="https://kit.fontawesome.com/646ac4fad6.js" crossorigin="anonymous"></script>

</head>

<body>


    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold border-bottom"><i
                    class="bx bx-bowl-hot"></i><a href="/"class=" text-success">FudRater</a></div>
            <div class="list-group list-group-flush my-3">


                <a href="/panelusuario/perfil" id="btn_perfil" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-tachometer-alt me-2"></i>Perfil</a>

                <a href="/panelusuario/resenyas" id="btn_resenya" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Mis reseñas</a>

                <a href="/panelusuario/admin" id="btn_admin" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Admin</a>


                <a href="/logout" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>

        <!-- Page Content -->
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

            

<div class="container rounded bg-white mt-1 mb-1">

    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                <span class="font-weight-bold">{{auth()->user()->name}} {{auth()->user()->apellido}}</span>
                <span class="text-black-50">{{auth()->user()->email}}</span>
                <span> </span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <form action="{{route("home.modperfil")}}" method="POST">
                    @csrf
                    <input name="email" value={{auth()->user()->email}} type="hidden">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Perfil</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Nombre</label><input type="text" name="name" class="form-control"  value={{auth()->user()->name}}></div>
                        <div class="col-md-6"><label class="labels">Apellido</label><input type="text" class="form-control" name="apellido" value={{auth()->user()->apellido}} ></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Teléfono</label><input type="text" class="form-control" name="telefono" value={{auth()->user()->telefono}}></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Dirección</label><input type="text" class="form-control" name="direccion" value={{auth()->user()->direccion}}></div>
                        <div class="col-md-6"><label class="labels">Pais</label><input type="text" class="form-control" name="pais" value={{auth()->user()->pais}}></div>
                        <div class="col-md-6"><label class="labels">Provincia</label><input type="text" class="form-control" name="provincia" value={{auth()->user()->provincia}} ></div>
                        <div class="col-md-6"><label class="labels">Población</label><input type="text" class="form-control" name="poblacion" value={{auth()->user()->poblacion}} ></div>
                        <div class="col-md-6"><label class="labels">Código postal</label><input type="text" class="form-control" name="cod_postal" value={{auth()->user()->cod_postal}}></div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Guardar</button>
                    </div>
                    @if (session("correcto"))
                    <div class="aler alert-success text-center">{{session("correcto")}}</div>
                    @endif
                    @if (session("incorrecto"))
                    <div class="aler alert-danger text-center">{{session("incorrecto")}}</div>
                    @endif

                </form>
            </div>

        </div>

    </div>
</div>

<a href="/test" id="btn_resenya" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
    class="fas fa-project-diagram me-2"></i>test</a>
    {{session("test")}}


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
