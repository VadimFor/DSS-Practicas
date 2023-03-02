<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-user-secret me-2"></i>FudRater</div>
            <div class="list-group list-group-flush my-3">

                <a href="#" id="btn_perfil" onclick="switchContent('panel_perfil')" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-tachometer-alt me-2"></i>Perfil</a>

                <a href="#" id="btn_resenya" onclick="switchContent('panel_resenyas')"  class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Mis reseñas</a>

                <a href="#" id="btn_admin" onclick="switchContent('panel_admin')" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Admin</a>


                <a href="/logout" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

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
                                <i class="fas fa-user me-2"></i><?php echo e(auth()->user()->email ?? auth()->user()->email); ?>

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

            <div id="_panel_perfil" style="display:block;">
                <?php echo $__env->make('panel_perfil', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div id="_panel_resenyas" style="display:none;">
                <?php echo $__env->make('panel_resenyas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div id="_panel_admin" style="display:none;">
                <?php echo $__env->make('panel_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script>
        function switchContent(msg) {

            if(msg == "panel_perfil"){
                console.log("perfil");
                document.getElementById("_panel_perfil").style.display = "block";
                document.getElementById("btn_perfil").classList = "list-group-item list-group-item-action bg-transparent second-text active";
                document.getElementById("btn_resenya").classList = "list-group-item list-group-item-action bg-transparent second-text fw-bold";
                document.getElementById("btn_admin").classList = "list-group-item list-group-item-action bg-transparent second-text fw-bold";

                document.getElementById("_panel_resenyas").style.display = "none";
                document.getElementById("_panel_admin").style.display = "none";

            }else if(msg == "panel_admin"){
                console.log("admin");
                document.getElementById("_panel_admin").style.display = "block";
                document.getElementById("btn_perfil").classList = "list-group-item list-group-item-action bg-transparent second-text fw-bold";
                document.getElementById("btn_resenya").classList = "list-group-item list-group-item-action bg-transparent second-text fw-bold";
                document.getElementById("btn_admin").classList = "list-group-item list-group-item-action bg-transparent second-text active";

                document.getElementById("_panel_perfil").style.display = "none";
                document.getElementById("_panel_resenyas").style.display = "none";
            }else{
                console.log("reseñas");
                document.getElementById("_panel_resenyas").style.display = "block";
                document.getElementById("btn_perfil").classList = "list-group-item list-group-item-action bg-transparent second-text fw-bold";
                document.getElementById("btn_resenya").classList = "list-group-item list-group-item-action bg-transparent second-text active";
                document.getElementById("btn_admin").classList = "list-group-item list-group-item-action bg-transparent second-text fw-bold";

                document.getElementById("_panel_perfil").style.display = "none";
                document.getElementById("_panel_admin").style.display = "none";

            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>

cripts
</body>

</html>
<?php /**PATH /home/vadym/Escritorio/DSS/dss/resources/views/panelusuario.blade.php ENDPATH**/ ?>