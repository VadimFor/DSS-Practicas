<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplicación de registro</title>
    <link rel="stylesheet" href="{{ url('/assets/css/bootstrap.min.css')}}">

    <style>
        body{
            width: 100%;
            height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container{
            width: 400px;
        }
    </style>

</head>
<body>

    <main class="form-container">

        <form action="/registro" method="POST">
            @csrf
            <h1>Registro</h1>
            @include('layouts.partials.messages')
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Verificar contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="row mt-3" style="border: solid 0.1px; border-radius: 20px; margin:2px">
                <div style="width: 100%; text-align: center">OPCIONAL</div>
                <div class="col-md-6"><label class="labels">Nombre</label><input name="name" type="text" class="form-control"  value=""></div>
                <div class="col-md-6"><label class="labels">Apellido</label><input name="apellido" type="text" class="form-control" value=""></div>
                <div class="col-md-6"><label class="labels">Telefono</label><input name="telefono" type="text" class="form-control" value=""></div>
                <div class="col-md-6"><label class="labels">Pais</label><input name="pais" type="text" class="form-control" value=""></div>
                <div class="col-md-6"><label class="labels">Provincia</label><input name="provincia" type="text" class="form-control" value="" ></div>
                <div class="col-md-6"><label class="labels">Población</label><input name="poblacion" type="text" class="form-control" value="" ></div>
                <div class="col-md-6"><label class="labels">Código postal</label><input name="cod_postal" type="text" class="form-control" value=""></div>
                <div class="col-md-6"><label class="labels">Direccion</label><input name="direccion" type="text" class="form-control" value=""></div>
                <div style="margin-bottom: 15px"></div>
            </div>
            <div style="margin-bottom: 30px"></div>

            <div class="container">
                <div class="row">
                  <div class="col text-center">
                        <button type="submit" class="btn btn-primary"  style="width:100%" >Crear cuenta</button>
                        <div> </div>
                        <a style="font-size:12px;" href="/login">Iniciar sesión</a>
                    </div>
                </div>
            </div>
      </form>

    </main>

    <script src="{{ url('/assets/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
