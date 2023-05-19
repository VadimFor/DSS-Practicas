

<style>
    .btn_container {
        margin-top: 50px;
      height: 75px;
      position: relative;

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


<script>
    var res=function($nombre){
        var not=confirm("¿Eliminar al menú '" + $nombre + "' ?");
        return not;
    }
</script>


<!--
█▀▄▀█ █▀█ █▀▄ ▄▀█ █░░   █▀▄▀█ █▀▀ █▄░█ █░█
█░▀░█ █▄█ █▄▀ █▀█ █▄▄   █░▀░█ ██▄ █░▀█ █▄█-->
<div style="font-size:20px; " class="modal fade" id="modalMenu{{$menu->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    @php
        $matchingMenu = \App\Models\Menu::where('id', $menu->id)->first(); //Obtengo toda la columna
        $matchingMenu_platos = \App\Models\Plato::where('menu_id', $menu->id)->get(); //Obtengo todos los platos de este menu.
    @endphp 
    
    <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 5%;">

        <!--▀█▀ █ ▀█▀ █░█ █░░ █▀█
            ░█░ █ ░█░ █▄█ █▄▄ █▄█ -->
        <div class="modal-header text-center">
            <h2 style="width:100%;text-align: center;" class="modal-title " id="exampleModalLabel">{{$matchingMenu->nombre}}</h2>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>


        <!--█░░ █ █▀ ▀█▀ ▄▀█   █▀▄ █▀▀   █▀█ █░░ ▄▀█ ▀█▀ █▀█ █▀
            █▄▄ █ ▄█ ░█░ █▀█   █▄▀ ██▄   █▀▀ █▄▄ █▀█ ░█░ █▄█ ▄█ -->
        <div class="modal-body" style="text-shadow: none; ">
               
            @if (count($matchingMenu_platos) == 0)
                <div style="text-align:center; margin-bottom:50px; margin-top:25px;">Este menú no tiene platos.</div>
            @else

                <table class="table bg-white rounded shadow-sm table-bordered table-hover">

                    <thead>
                        <tr>
                            <th style="text-align:center" scope="col">Lista de platos</th>

                            @auth <!--Solo usuarioS logueados -->
                                @if ($mi_restaurante == true) <!-- Si el menu pertenece al usuario logeado-->
                                    <th scope="col" style="width: 10px"></th><!--Eliminar -->
                                @endif
                            @endauth
    
                        </tr>
                    </thead>

                    <tbody class="table-group-divider">

                        @foreach ($matchingMenu_platos as $plato)

                        <tr>

                            <td style="text-align: center">{{$plato->nombre}}</td>

                            <!--█▀▀ █░░ █ █▀▄▀█ █ █▄░█ ▄▀█ █▀█   █▀█ █░░ ▄▀█ ▀█▀ █▀█
                                ██▄ █▄▄ █ █░▀░█ █ █░▀█ █▀█ █▀▄   █▀▀ █▄▄ █▀█ ░█░ █▄█ -->
                            @auth <!--Solo usuarioS logueados -->
                                @if ($mi_restaurante == true) <!-- Si el menu pertenece al usuario logeado-->

                                    <form method="POST" action="{{ route('RestauranteDetalleController.delPlato', ['id' => $plato->id]) }}">
                                        @method('post')
                                        @csrf
                                        <td>
                                            <button type="submit"  class="btn btn-danger btn-sm styleiconos icon-basura"></button>
                                        </td>
                                    </form>

                                   <!--Para evitar el page refresh -->
                                    @if(Session::get('plato_correcto') != '' || Session::get('plato_incorrecto') != '')  
                                    <script>
                                        var menuId = {{$menu->id}}; // Assign the value to a variable
                                        //console.log("menuId= " + menuId); 
                                        $(function() { $('#modalMenu' + menuId).modal('show');});
                                    </script>
                                    @endif

                                @endif
                            @endauth

                        </tr>

                        @endforeach

                        <!--Para mostrar el resultado de borrar plato -->
                        @if(Session::has('plato_correcto'))
                            <div style="text-align:center" class="alert alert-success">
                                {{ Session::get('plato_correcto') }}
                            </div>
                        @endif
                        <!--Para mostrar el resultado de borrar plato -->
                        @if(Session::has('plato_incorrecto'))
                            <div style="text-align:center" class="alert alert-danger">
                                {{ Session::get('plato_incorrecto') }}
                            </div>
                        @endif

                    </tbody>

                </table> 

            @endif

            <!--▄▀█ █▄░█ ▄▀█ █▀▄ █ █▀█   █▀█ █░░ ▄▀█ ▀█▀ █▀█
                █▀█ █░▀█ █▀█ █▄▀ █ █▀▄   █▀▀ █▄▄ █▀█ ░█░ █▄█-->
            @auth <!--Solo usuarioS logueados -->
                @if ($mi_restaurante == true) <!-- Si el menu pertenece al usuario logeado-->
                    <table class="table bg-white rounded shadow-sm table-bordered table-hover">

                        <thead>
                        
                            <tr>
                                <th style="text-align: center; background-color:rgb(252, 251, 248)" scope="col">Añadir plato</th>
                                <th style="text-align: center; background-color:rgb(252, 251, 248)" scope="col"></th>
                            </tr>
                        
                        </thead>
                        
                        <tbody class="table-group-divider">
                        
                            <tr>      
                                <form method="POST" action="{{route('RestauranteDetalleController.crearPlato')}}">
                                    @method('post')
                                    @csrf

                                    <td style="background-color:rgb(252, 251, 248)"> 
                            
                                        <input type="text" name="nombre" class="form-control" placeholder="" required>

                                    </td>
                                    
                                    <input type="text" name="menu_id" value={{$menu->id}} style="display: none;">
                                    <input type="text" name="descripcion" style="display: none;" value="Sin descripción">
                                    <input type="text" name="img" style="display: none;">

                                    <td style="width: 10px; background-color:rgb(252, 251, 248)">
                                        <button type="submit"  class="btn btn-sm styleiconos icon-crear"></button>
                                    </td>
                                    
                                </form>
        
                            </tr>
                            
                        </tbody>
                            
                    </table> 
                @endif
            @endauth
            
            <!-- NOTA: falta añadir el div en la table (si lo descomento)
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    document.getElementById('btnaddplato').addEventListener('click', function() {
                        document.getElementById('addplato').style.display = 'block';
                    });
                });
            </script>
            -->


            <!--█▄▄ █▀█ ▀█▀ █▀█ █▄░█ █▀▀ █▀
                █▄█ █▄█ ░█░ █▄█ █░▀█ ██▄ ▄█-->
            @auth <!--Solo usuarioS logueados -->

                @if ($mi_restaurante == true) <!-- Si el menu pertenece al usuario logeado-->

    
                <div class="btn_container">
                    <div class="list-group horizontal-list-group">
                        
                        <!--█▀▄▀█ █▀█ █▀▄ █ █▀▀ █ █▀▀ ▄▀█ █▀█   █▀▄▀█ █▀▀ █▄░█ █░█
                            █░▀░█ █▄█ █▄▀ █ █▀░ █ █▄▄ █▀█ █▀▄   █░▀░█ ██▄ █░▀█ █▄█ -->
                        <!--<button id="btnaddplato" style="background-color:rgb(210, 226, 241)" type="submit" class="list-group-item list-group-item-action btn btn-info">Añadir plato</button>-->
                        <button style="background-color:rgb(210, 226, 241)" type="submit" class="list-group-item list-group-item-action btn btn-info">Modificar menu</button>
                        

                        <!--█▀▀ █░░ █ █▀▄▀█ █ █▄░█ ▄▀█ █▀█   █▀▄▀█ █▀▀ █▄░█ █░█
                            ██▄ █▄▄ █ █░▀░█ █ █░▀█ █▀█ █▀▄   █░▀░█ ██▄ █░▀█ █▄█ -->
                        <form method="POST" action="{{ route('RestauranteDetalleController.delMenu', ['id' => $matchingMenu->id]) }}">
                            @method('post')
                            @csrf
                            <button type="button" onclick="return res('{{$matchingMenu->nombre}}')" class="btn btn-danger">Eliminar menu</button>
                        </form>

                    </div>
                </div>

                @endif

            @endauth
  

        </div>

    </div>
    </div>
</div>

