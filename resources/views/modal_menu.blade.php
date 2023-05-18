

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

        <!--ＨＥＡＤ -->
        <div class="modal-header text-center">
            <h2 style="width:100%;text-align: center;" class="modal-title " id="exampleModalLabel">{{$matchingMenu->nombre}}</h2>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>


        <!--ＢＯＤＹ -->
        <div class="modal-body" style="text-shadow: none; ">
               
            @if (count($matchingMenu_platos) == 0)
                <div style="text-align:center">Este menú no tiene platos.</div>
                

            @else

                <ul class="list-group">
                @foreach ($matchingMenu_platos as $plato)

                    <li style="text-align:center" class="list-group-item v_hov ">{{$plato->nombre}}</li>

                @endforeach
                </ul>

            @endif

            <!--ＯＰＣＩＯＮＥＳ ＤＥＬ ＭＥＮＵ -->
            @auth <!--Solo usuarioS logueados -->

                @if ($mi_restaurante == true) <!-- Si el menu pertenece al usuario logeado-->

    
                <div class="btn_container">
                    <div class="list-group horizontal-list-group">
                        
                        <button style="background-color:rgb(210, 226, 241)" type="submit" class="list-group-item list-group-item-action btn btn-info">Añadir plato</button>
                        <button style="background-color:rgb(210, 226, 241)" type="submit" class="list-group-item list-group-item-action btn btn-info">Modificar menu</button>
                        
                        <form method="POST" action="{{ route('RestauranteDetalleController.delMenu', ['id' => $matchingMenu->id]) }}">
                            @method('post')
                            @csrf
                            <button type="submit" onclick="return res('{{$matchingMenu->nombre}}')" class="btn btn-danger">Eliminar menu</button>
                        </form>

                    </div>
                </div>



                @endif

            @endauth
  

        </div>

    </div>
    </div>
</div>