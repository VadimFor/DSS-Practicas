<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplicación de login</title>
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
        <form action="/login" method="POST">
            @csrf
            <h1>Login</h1>
            @include('layouts.partials.messages')
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name ="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Recordarme</label>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
            <div> </div>
            <div class="">
                <a style="font-size:12px;" href="/registro">Crear cuenta</a>
            </div>
        </form>
    </main>

    <script src="{{ url('/assets/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
