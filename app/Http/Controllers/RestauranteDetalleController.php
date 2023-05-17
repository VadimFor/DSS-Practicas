<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Valoracion;
use Exception;

class RestauranteDetalleController extends Controller
{
    public function listaMenus($id)
    {                
        $menus = Menu::where('restaurante_id', '=', $id)->get();
        $valoracionesPorMenu = [];

        // Iterar por cada menú y obtener las valoraciones relacionadas
        foreach ($menus as $menu) {
            // Obtener las valoraciones relacionadas con el menú actual
            $valoraciones = Valoracion::where('menu_id', '=', $menu->id)->get();

            // Almacenar las valoraciones en el array con la clave del menú
            $valoracionesPorMenu[$menu->id] = $valoraciones;
        }

        //Obtengo si el restaurante es del usuario autenticado
        $restaurante = Restaurante::where('id', '=', $id)->first(); // Retrieve the first matching object
        $mi_restaurante = $restaurante->users_id == auth()->user()->id ? true : false;

        $cantidad_menus = count($menus);
   
        return view('restaurante_detalle')->with('menus', $menus)->with('restaurante', $restaurante)->with('valoracionesPorMenu', $valoracionesPorMenu)->with('mi_restaurante', $mi_restaurante)
        ->with('cantidad_menus', $cantidad_menus);
    }

    public function listaPlatos($id)
    {
        $menu = Menu::where('id','=',$id)->get();
        $platos = $menu[0]->plato;
        return response()->json($platos);
    }


    public function crear(Request $request){

        $img = $request->img;

        if($request->img == NULL){
            $img =  '/public/storage/img/user/menu.png';
        }

        try{
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:30',
                'descripcion' => 'max:500',
                'precio' => 'required|numeric',
                'restaurante_id' => 'required|integer',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
            ]);


            Menu::create($validatedData);

            return back()->with("correcto","Menu creado correctamente.");

        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            return back()->with("incorrecto",$errorMessage);
        }
 
    }

}
