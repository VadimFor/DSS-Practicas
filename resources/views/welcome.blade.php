
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <title>Home</title>

    </head>


    <body>

        @include('navbar')
        @if (session('error-message'))
            <div class="alert alert-danger">
                <ul>                
                    <li>{{ session('error-message') }}</li>
                </ul>
            </div>
        @endif
        TOP MENUS

        @include('welcome_contenido')

        @include('footer')



        <script src="{{ url('/assets/js/bootstrap.bundle.min.js')}}"></script>

    </body>


</html>



