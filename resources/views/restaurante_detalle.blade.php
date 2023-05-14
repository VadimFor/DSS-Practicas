<!DOCTYPE html>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
                padding: 5%;
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

            .mostrar-modal{
                display: block;
                padding-right: 17px;
            }
            .flex-container {
              display: flex;
              flex-wrap: nowrap;
              background-color: #b7dac6;
              align-items: center;
            }

        </style>
        <title>Detalle Menu</title>

    </head>
<body>
<script>
    // donde vamos a indicar la redireccion de la página
function myFunction() {
  document.getElementById("demo").innerHTML = "YOU CLICKED ME!";
}

async function recuperarPlatosMenu(id, nombre, precio) {
    const request = {
    method: 'GET'
  };
  console.log(id);
    let resultado = await fetch(`http://127.0.0.1:8000/platos-menu-${id}`, request)
  .then(function(response) {
    if (!response.ok) {
      throw Error(response.statusText);
    }
    return response.json();
  })
  .then(function(responseAsObject) {

    document.querySelector("#bodyModal").innerHTML = '';
    document.querySelector("#menuModal").classList.add("mostrar-modal");
    document.querySelector("#menuModal").style.opacity = 1;
    document.querySelector("#menuNameModal").innerHTML = nombre;
    document.querySelector("#menuPriceModal").innerHTML = precio + '€';

    var i = 0;

    for (const objeto of responseAsObject){
        console.log(objeto);
        // Se alterna el posicionamiento de los elementos
        if(i % 2 == 0){
          document.querySelector("#bodyModal").innerHTML += `
              <p>
                  <div style="display: inline-flex">
                      <div style="max-width:65%">
                          <h2 style="padding-left:50px;font-size:40px;max-width: 80%">${objeto['nombre']}</h2>
                          <p style="padding-left:50px;font-size:30px;max-width: 80%">${objeto['descripcion']}</p>
                      </div>
                      <img src="${objeto.img}" style="display:block;width:60%;height:60%;border-radius:50%;object-fit: cover">
                  </div>
              </p>
              `;
        }else{
          document.querySelector("#bodyModal").innerHTML += `
              <p>
                  <div style="display: inline-flex">
                      <img src="${objeto.img}" style="display:block;width:60%;height:60%;border-radius:50%;object-fit: cover">
                      <div>
                          <h2 style="font-size:40px;padding-left:80px;max-width: 100%">${objeto['nombre']}</h2>
                          <p style="font-size:30px;padding-left:80px;max-width: 100%">${objeto['descripcion']}</p>
                      </div>
                  </div>
              </p>
              `;
        }
        i++;
    }
  })
  .catch(function(error) {
    console.log(error);
  });
}
</script>
    @include('navbar')
     <div class="header flex-container">
        <img src="{{url($restaurante->first()->img)}}" alt="resto-img" style="width: 30%;
  height: 400px;
  margin: 2%;border-radius: 8%;border: 8px solid #75a689;">
      <div style="justify-content: center;padding:1%;font-weight:bold;font-variant:small-caps;text-shadow: 2px 1px green;">
        <h1>{{$restaurante->first()->nombre}}</h1>
        <h2>{{$restaurante->first()->descripcion}}</h2>
        <h4 style="padding-left:20px;">Dirección: {{$restaurante->first()->direccion}}</h4>
        <h4 style="padding-left:20px;">Telefono: {{$restaurante->first()->telefono}}</h4>
      </div>
    </div>

    <div>        
        
        <div>
            
            <div class="main card-deck">
            
            @foreach ($menus as $menu)
                <div class="card des button">
                    <img onclick="recuperarPlatosMenu({{$menu->id}}, '{{$menu->nombre}}', {{$menu->precio}})" src="{{url($menu->img)}}" alt="img" data-toggle="modal" data-target="#menuModal" style="display:block;margin-left: auto;margin-right: auto;object-fit:contain;border-radius: 50%;max-width:90%;padding-bottom: inherit;">
                    <h4 class="thick">{{$menu->nombre}}</h4>
                    <p>{{$menu->descripcion}}</p>
                    <p class="thick"> Precio: {{$menu->precio}}€</p>
                    
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

    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="menuModal" role="dialog">
          <div class="modal-dialog" style="top:150px;max-width:700px">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="margin-top:0px">&times;</button>
                <h4 class="modal-title" id="menuNameModal" style="font-size:xxx-large;font-weight:bold"></h4>
                <p id="menuPriceModal" style="font-size: xx-large; margin-top:25px"></p>
              </div>
              <div class="modal-body" id="bodyModal">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>

</body>
</html>
