<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>HOME</h1>

    @auth
    <p>Bienvenido {{auth()->user()->name ?? auth()->user()->email}},estás autenticado a la página</p>
    <p><a href="/logout">Logout</a></p>
    @endauth

    @guest
    <p>Para ver el contenido <a href ="/login">Inicia sesión </a></p>
    @endguest
</body>
</html>
