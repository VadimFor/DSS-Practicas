<!DOCTYPE html>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <style>

            .main{

            margin: 2%;
            }

            .card{
                width: 20%;
                display: inline-block;
                box-shadow: 2px 2px 20px black;
                border-radius: 5px; 
                margin: 2%;
                }

            .image img{
            width: 100%;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            
            }

            .title{
            
            text-align: center;
            padding: 10px;
            
            }

            h1{
                font-size: 50px;
                font-weight: bold;
                padding: 20px;
            }
            h2{
                font-size: 30px;
                padding: 20px;
            
            }

            .des{
            padding: 3px;
            text-align: center;
            
            padding-top: 10px;
            padding-bottom: 15px;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
            }
            button{
            margin-top: 40px;
            margin-bottom: 10px;
            background-color: white;
            border: 1px solid black;
            border-radius: 5px;
            padding:10px;
            }
            button:hover{
            background-color: black;
            color: white;
            transition: .5s;
            cursor: pointer;
            }

            .fa-star, .fa-star-half-alt{
                    color: #ffbf00;
            }

            .thick{
                font-weight: bold;
            }


        </style>
        <title>Detalle Menu</title>

    </head>
<body>
    @include('navbar')
     <div class="header">
        <h1>{{$restaurante->first()->nombre}}</h1>
        <h2>{{$restaurante->first()->descripcion}}</h2>
    </div>    
    <div>        
        
        <div>
            
            <div class="main card-deck">
            
            @foreach ($menus as $menu)
                <div class="card des button">
                    <img src="{{$menu->img}}">
                    <h4 class="thick">{{$menu->nombre}}</h4>
                    <p>{{$menu->descripcion}}</p>
                    <p class="thick"> Precio: {{$menu->precio}}</p>
                    
                    <ul class="list-inline text-center m-0">
                    @foreach ($valoracionesPorMenu[$menu->id] as $valoracion)
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $valoracion->puntuacion)
                                <li class="list-inline-item"><i class="fas fa-star"></i></li>
                            @else
                                <li class="list-inline-item"><i class="far fa-star"></i></li>
                            @endif
                        @endfor
                    @endforeach
                    </ul>
                    
                </div>
            @endforeach

            </div>
        </div>
    </div> 

    @include('footer')
</body>
</html>
