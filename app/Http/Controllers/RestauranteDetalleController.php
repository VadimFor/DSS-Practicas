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
        $menus = Menu::where('restaurante_id', '=', $id)->get(); //SACO LOS MENUS DE ESTE RESTAURANTE
        $valoracionesPorMenu = [];

        //SACAR VALORACION MEDIA DE CADA MENU DE ESTE RESTAURANTE
        $i = 0;
        foreach ($menus as $menu) {
            // Obtener las valoraciones relacionadas con el menú actual
            $valoraciones = Valoracion::where('menu_id', '=', $menu->id)->get();

            $totalValoraciones = count($valoraciones);
            $sumaValoraciones = 0;

            foreach ($valoraciones as $valoracion) {
                $sumaValoraciones += $valoracion->puntuacion;
            }

            $valoracionMedia = ($totalValoraciones > 0) ? ($sumaValoraciones / $totalValoraciones) : 0;

            // Almacenar las valoraciones en el array con la clave del menú
            $valoracionesPorMenu[$i] = ceil($valoracionMedia);

            $i = $i + 1;
        }

        //Obtengo si el restaurante es del usuario autenticado
        $restaurante = Restaurante::where('id', '=', $id)->first(); // Retrieve the first matching object

        $mi_restaurante = false;
        if(auth()->user()){
            $mi_restaurante = $restaurante->users_id == auth()->user()->id ? true : false;
        }

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

    // CREAR MENU
    public function crear(Request $request){

        try{
            error_log("image= ". $request->img);

            $request->validate([
                'nombre' => 'required|string|max:30',
                'descripcion' => 'required|min:10|max:60',
                'precio' => 'required|numeric',
                'restaurante_id' => 'required|integer',
                'img' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
            ]);

            if($request->img == NULL){
                $img = 'menu.jpg';
            }else{
                $img = $request->img;
            }


            $menu = Menu::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'restaurante_id' => $request->restaurante_id,
                'img' => $img,
            ]);

            if($request->img != NULL){          
                $imageoriginalName =  $request->file('img')->getClientOriginalName();
                $extension = $request->file('img')->getClientOriginalExtension();
                $imageName =  $menu->id . '|menu.' .  $extension;

                Menu::where('id', $menu->id)->update(['img' => $imageName]);
                $request->file('img')->storeAs('public/img/menu/', $imageName); //subo a la carpeta la imagen
            }

            return back()->with("correcto","Menu creado correctamente.");

        }
        catch (Exception $e) {
            $errorMessage = $e->getMessage();
            return back()->with("incorrecto",$errorMessage);
        }

 
    }

}
