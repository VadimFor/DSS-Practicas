

<style>
    .btn_container {
        margin-top: 50px;
      height: 75px;
      position: relative;

    }
    
    .btn_center {
      margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
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

                @foreach ($matchingMenu_platos as $plato)

                    <div style="text-align:center">{{$plato->nombre}}</div>



                @endforeach

            @endif

            <!--ＯＰＣＩＯＮＥＳ ＤＥＬ ＭＥＮＵ -->
            @auth <!--Solo usuarioS logueados -->

                @if ($mi_restaurante == true) <!-- Si el menu pertenece al usuario logeado-->

                    <div class="btn_container">
                        <div class="btn_center">
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