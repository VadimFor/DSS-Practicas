
<style>
    .btn_container {
      margin-top: 20px;
      height: 75px;
      position: relative;

    }

    .btn_div {
        display: flex;
        justify-content: center;
        align-items: center;
    }


    .v_hov:hover {
        transition: background-color .5s;
        background-color: rgb(240, 238, 225);
    }

    .horizontal-list-group {
        display: flex;
        flex-direction: row;
    }

    .horizontal-list-group .list-group-item {
        flex-grow: 0;
        text-align: center;
        white-space: nowrap;
    }

    .icon-basura{background-image: url('/icons/icon-basura.svg');}
    .icon-crear{background-image: url('/icons/icon-crear.svg');}
    .styleiconos{
            width: 30px;
            height: 30px;
            background-size: 75% 75%;
            background-repeat: no-repeat;
            color: white;
            text-align:center;
            background-position-x: center;
            background-position-y: center;
        }

</style>



<!--
█▀▄▀█ █▀█ █▀▄ ▄▀█ █░░   █▀▀ █▀█ █▀▄▀█ █▀▀ █▄░█ ▀█▀ ▄▀█ █▀█ █ █▀█ █▀
█░▀░█ █▄█ █▄▀ █▀█ █▄▄   █▄▄ █▄█ █░▀░█ ██▄ █░▀█ ░█░ █▀█ █▀▄ █ █▄█ ▄█  -->
<div style="font-size:20px;" class="modal fade" id="modalComentariosMenu{{$menu->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    @php
        $matchingMenu = \App\Models\Menu::where('id', $menu->id)->first(); //Obtengo toda la columna
        //$matchingMenu_platos = \App\Models\Plato::where('menu_id', $menu->id)->get(); //Obtengo todos los platos de este menu. 
        $matchingMenu_valoraciones = \App\Models\Valoracion::where('menu_id', $menu->id)->get(); //Obtengo todos los platos de este menu. 

    @endphp 
    
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 5%; width=2000px">

        <!--▀█▀ █ ▀█▀ █░█ █░░ █▀█
            ░█░ █ ░█░ █▄█ █▄▄ █▄█ -->
        <div class="modal-header text-center">
            <h2 style="width:100%;text-align: center;" class="modal-title " id="exampleModalLabel">Valoraciones de '{{$matchingMenu->nombre}}'</h2>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>


        <!--█░░ █ █▀ ▀█▀ ▄▀█   █▀▄ █▀▀   █▀▀ █▀█ █▀▄▀█ █▀▀ █▄░█ ▀█▀ ▄▀█ █▀█ █ █▀█ █▀
            █▄▄ █ ▄█ ░█░ █▀█   █▄▀ ██▄   █▄▄ █▄█ █░▀░█ ██▄ █░▀█ ░█░ █▀█ █▀▄ █ █▄█ ▄█ -->
        <div class="modal-body" style="text-shadow: none; ">
               
            @if (count($matchingMenu_valoraciones) == 0)
                <div style="text-align:center; margin-bottom:50px; margin-top:25px;">Este menú no tiene valoraciones.</div>
            @else

                <table class="table bg-white rounded shadow-sm table-bordered table-hover">

                    <thead>
                        <tr>
                            <th style="text-align:center" scope="col">Puntos</th>
                            <th scope="col" style="text-align:center; " >Comentario</th>
                            <th style="text-align:center" scope="col">Usuario</th>


                            @auth <!--Solo usuarioS logueados -->
                                <th scope="col" style="width: 10px"></th><!--Eliminar -->
                            @endauth
    
                        </tr>
                    </thead>

                    <tbody class="table-group-divider">

                        @foreach ($matchingMenu_valoraciones as $valoracion)

                            @php
                                $usuario_de_la_valoracion =  \App\Models\Users::where('id', $valoracion->users_id)->first();
                            @endphp

                            <tr>

<<<<<<< HEAD
                                <td  style="text-align: center">{{$valoracion->puntuacion}}</td>
                                <td  style="font-size:18px; ">{{$valoracion->comentario}}</td>
                                <td  style="text-align: center">{{$usuario_de_la_valoracion->email  }}</td>
=======
                                <td style="text-align: center">
                                    @for ($i = 0; $i < $valoracion->puntuacion; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </td>
                                <td style="font-size:18px; ">{{$valoracion->comentario}}</td>
                                <td style="text-align: center">
                                    <img src="storage/img/user/{{$usuario_de_la_valoracion->email}}|perfil.jpg" style="border-radius:50%; max-height:100px" title="{{$usuario_de_la_valoracion->email}}">
                                </td>
>>>>>>> e60d03d64628e24087cdfcee6f80ba2d2ec9b15e


                                <!--█▀▀ █░░ █ █▀▄▀█ █ █▄░█ ▄▀█ █▀█   █░█ ▄▀█ █░░ █▀█ █▀█ ▄▀█ █▀▀ █ █▀█ █▄░█
                                    ██▄ █▄▄ █ █░▀░█ █ █░▀█ █▀█ █▀▄   ▀▄▀ █▀█ █▄▄ █▄█ █▀▄ █▀█ █▄▄ █ █▄█ █░▀█-->
                                @auth <!--Solo usuarioS logueados -->

                                    <!--Para evitar el page refresh -->
                                    @if(Session::get('valoracion_correcto') != '' || Session::get('valoracion_incorrecto') != '')  
                                    <script>
                                        var menuId = {{$menu->id}}; // Assign the value to a variable
                                        //console.log("menuId= " + menuId); 
                                        $(function() { $('#modalComentariosMenu' + menuId).modal('show');});
                                    </script>
                                    @endif


                                    @php 
                                        $mi_valoracion = $valoracion->users_id == auth()->user()->id;
                                    @endphp

                                    @if ($mi_valoracion == true)  <!--Solo si la valoración la he escrito yo-->

                                        <form method="POST" action="{{ route('RestauranteDetalleController.delValoracion', ['id' => $valoracion->id]) }}">
                                            @method('post')
                                            @csrf
                                            <td>
                                                <button type="submit"  class="btn btn-danger btn-sm styleiconos icon-basura"></button>
                                            </td>
                                        </form>



                                    @endif
                                @endauth

                            </tr>

                        @endforeach

                        <!--Para mostrar el resultado de borrar valoracion -->
                        @if(Session::has('valoracion_correcto'))
                            <div style="text-align:center" class="alert alert-success">
                                {{ Session::get('valoracion_correcto') }}
                            </div>
                        @endif
                        <!--Para mostrar el resultado de borrar valoracion -->
                        @if(Session::has('valoracion_incorrecto'))
                            <div style="text-align:center" class="alert alert-danger">
                                {{ Session::get('valoracion_incorrecto') }}
                            </div>
                        @endif

                    </tbody>

                </table> 

            @endif

            @auth <!--Solo usuarioS logueados -->

                @php
                    $mis_valoraciones = \App\Models\Valoracion::where('menu_id', $matchingMenu->id)
                                 ->where('users_id', auth()->user()->id)
                                 ->get();   

                    error_log(json_encode($mis_valoraciones->toArray()));

                @endphp


                @if (count($mis_valoraciones) == 0 && !$mi_restaurante) <!-- Si no tengo ninguna valoracion de este menu y no soy el dueño-->
                    <!--
                    ▀█▀ ▄▀█ █▄▄ █░░ ▄▀█   ▄▀█ █▄░█ ▄▀█ █▀▄ █ █▀█   █░█ ▄▀█ █░░ █▀█ █▀█ ▄▀█ █▀▀ █ █▀█ █▄░█
                    ░█░ █▀█ █▄█ █▄▄ █▀█   █▀█ █░▀█ █▀█ █▄▀ █ █▀▄   ▀▄▀ █▀█ █▄▄ █▄█ █▀▄ █▀█ █▄▄ █ █▄█ █░▀█-->
                    <table class="table bg-white rounded shadow-sm table-bordered table-hover">

                        <thead>
                        
                            <tr>
                                <th style="text-align: center; background-color:rgb(252, 251, 248); width:50px;" scope="col">Puntos</th>
                                <th style="text-align: center; background-color:rgb(252, 251, 248)" scope="col">Comentario</th>

                            </tr>                    
                        
                        </thead>
                        
                        <tbody class="table-group-divider">
                        
                            <tr>      
                                <form method="POST" action="{{route('RestauranteDetalleController.crearValoracion')}}">
                                    @method('post')
                                    @csrf

                                    <td style="background-color:rgb(252, 251, 248)"> 
                                        <input type="number" name="puntuacion" class="form-control" placeholder="" min="0" max="5" required>
                                    </td>
                                    <td style="background-color:rgb(252, 251, 248)"> 
                                        <input type="text" name="comentario" class="form-control" placeholder="" min="1" max="50" required>
                                    </td>

                                    <input type="text" name="users_id" style="display: none;" value="{{auth()->user()->id}}">
                                    <input type="text" name="menu_id" style="display: none;" value="{{$matchingMenu->id}}">

                                    <td style="width: 10px; background-color:rgb(252, 251, 248)">
                                        <button type="submit"  class="btn btn-sm styleiconos icon-crear"></button>
                                    </td>
                                    
                                </form>
        
                            </tr>
                            
                        </tbody>
                            
                    </table> 

                @endif
            @endauth

        </div>

    </div>
    </div>
</div>

