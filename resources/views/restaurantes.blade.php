
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

    <style>


.card{
    height: 17vw;


  transition:0.5s;
  cursor:pointer;

  box-shadow: 2px 2px 20px black;
    border-radius: 5px; 
    margin: 2%;
}
.card-title{  
  font-size:20px;
  transition:1s;
  cursor:pointer;
  box-shadow: 1px 1px 5px rgb(29, 139, 64);
}
.card-title i{  
    box-shadow: 2px 2px 20px rgb(30, 80, 92);
  font-size:25px;
  transition:1s;
  cursor:pointer;
  color:#000000dd
}
.card-title i:hover{
  transform: scale(1.25) rotate(100deg); 
  color:#18d4ca;
  
}
.card:hover{
  transform: scale(1.05);
  box-shadow: 10px 10px 15px rgba(0,0,0,0.3);
}
.card-text{
  height:80px;  
}

.card::before, .card::after {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  transform: scale3d(0, 0, 1);
  transition: transform .3s ease-out 0s;
  background: rgba(255, 255, 255, 0.1);
  content: '';
  pointer-events: none;
}
.card::before {
  transform-origin: left top;
}
.card::after {
  transform-origin: right bottom;
}
.card:hover::before, .card:hover::after, .card:focus::before, .card:focus::after {
  transform: scale3d(1, 1, 1);
}
    </style>


    <body>

        @include('navbar')

        <div class="container mt-2">

            <div class="row">

                                <!--
                █▄▄ █░█ █▀ █▀▀ ▄▀█ █▀█   █▀█ █▀▀ █▀ ▀█▀ ▄▀█ █░█ █▀█ ▄▀█ █▄░█ ▀█▀ █▀▀
                █▄█ █▄█ ▄█ █▄▄ █▀█ █▀▄   █▀▄ ██▄ ▄█ ░█░ █▀█ █▄█ █▀▄ █▀█ █░▀█ ░█░ ██▄-->
                <form action="{{ route('RestaurantesController.buscar') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3 p-3">
                        <input type="text" name="tabla" value="restaurante" style="display:none" readonly><!--Para identificar la tabla -->
                        <input type="text" name="busqueda-restaurante" class="form-control" placeholder="Buscar restaurante" aria-label="Buscar restaurante">
                        <button class="btn btn-outline-success" type="submit">Buscar</button>
                    </div>
                </form>
                
                <!-- 
                ▀█▀ ▄▀█ █▄▄ █░░ ▄▀█   █▄▄ █░█ █▀ █▀█ █░█ █▀▀ █▀▄ ▄▀█ █▀
                ░█░ █▀█ █▄█ █▄▄ █▀█   █▄█ █▄█ ▄█ ▀▀█ █▄█ ██▄ █▄▀ █▀█ ▄█-->
                @if(session('search-restaurante') && session('search-restaurante') != NULL)
                    <table class="table bg-white rounded shadow-sm table-bordered table-hover table-info ">

                        <thead>
                            <tr>
                                <th scope="col" width="50">Nombre</th>
                                <th scope="col">Direccción</th>
                                <th scope="col">Teléfono</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                            @foreach (session('search-restaurante') as $item)
                                <tr>
                                    <td>{{$item->nombre}}</td>
                                    <td>{{$item->direccion}}</td>
                                    <td>{{$item->telefono}}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{route("RestauranteDetalleController.listaMenus",$item->id)}}" >Visitar</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                @endif  

                <!-- 
                ▀█▀ ▄▀█ █▄▄ █░░ ▄▀█   █▄░█ █▀█ █▀█ █▀▄▀█ ▄▀█ █░░
                ░█░ █▀█ █▄█ █▄▄ █▀█   █░▀█ █▄█ █▀▄ █░▀░█ █▀█ █▄▄ -->
                @foreach ($restaurantes as $item)
                    <div class="col-md-3 col-sm-6" href="{{route("RestauranteDetalleController.listaMenus",$item->id)}}">

                            <div class="card card-block">
                                <h1 class="card-title text-center"><i class="material-icons">{{$item->nombre}}</i></h1>

                                <a class="btn btn-info" href="{{route("RestauranteDetalleController.listaMenus",$item->id)}}" >Visitar</a>

                                <img style="height:150px" src="{{asset('storage/img/restaurante/'.$item->img)}}">
                                <p class="card-title text-center">Tel.: {{$item->telefono}}</p> 
                                <p class="card-title">{{$item->direccion}}</p> 


                            </div>
                    </div>
                @endforeach
   
            </div>
          </div>

        @include('footer')


        <script src="{{ url('/assets/js/bootstrap.bundle.min.js')}}"></script>

    </body>


</html>



