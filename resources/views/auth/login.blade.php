<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="/login" method="POST">
        @csrf
        email
        <input type="email" name="email">
   
        password
        <input type="password" name="password">

        <input type="submit" value="Login">

    </form>
</body>
</html>