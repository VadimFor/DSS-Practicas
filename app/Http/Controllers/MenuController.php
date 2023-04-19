<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Valoracion;

class MenuController extends Controller
{
    public function listaMenus($id)
    {
        // Obtener todos los menús desde el modelo de Eloquent
        
        $restaurante = Restaurante::where('id','=',$id)->get();
        $menus = Menu::where('restaurante_id', '=', $id)->get(); // Suponiendo que tu modelo de menú se llama "Menu"
        $valoracionesPorMenu = [];

        // Iterar por cada menú y obtener las valoraciones relacionadas
        foreach ($menus as $menu) {
            // Obtener las valoraciones relacionadas con el menú actual
            $valoraciones = Valoracion::where('menu_id', '=', $menu->id)->get();

            // Almacenar las valoraciones en el array con la clave del menú
            $valoracionesPorMenu[$menu->id] = $valoraciones;
        }

        // Pasar los datos obtenidos a la vista y mostrarlos en la plantilla Blade
        return view('restaurante_detalle')->with('menus', $menus)->with('restaurante', $restaurante)->with('valoracionesPorMenu', $valoracionesPorMenu);
    }
}
