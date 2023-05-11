<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Valoracion;

class RestauranteDetalleController extends Controller
{
    public function listaMenus($id)
    {                
        $restaurante = Restaurante::where('id','=',$id)->get();
        $menus = Menu::where('restaurante_id', '=', $id)->get();
        $valoracionesPorMenu = [];

        // Iterar por cada menú y obtener las valoraciones relacionadas
        foreach ($menus as $menu) {
            // Obtener las valoraciones relacionadas con el menú actual
            $valoraciones = Valoracion::where('menu_id', '=', $menu->id)->get();

            // Almacenar las valoraciones en el array con la clave del menú
            $valoracionesPorMenu[$menu->id] = $valoraciones;
        }

        return view('restaurante_detalle')->with('menus', $menus)->with('restaurante', $restaurante)->with('valoracionesPorMenu', $valoracionesPorMenu);
    }

    public function listaPlatos($id)
    {
        $menu = Menu::where('id','=',$id)->get();
        $platos = $menu[0]->plato;
        return response()->json($platos);
    }
}
