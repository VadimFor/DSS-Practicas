<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Plato;
use App\Models\Valoracion;
use Exception;
use Illuminate\Support\Facades\DB;

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
        if(auth()->check()){
            $mi_restaurante = $restaurante->users_id == auth()->user()->id;
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
        $img = '';

        try{
            error_log("image= ". $request->img);
            error_log("hola");

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

            if($img != NULL){          
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

    public function delMenu($id){
        error_log("Eliminando a " . $id);

        try{ 
            DB::table('valoracion')->where('menu_id', $id)->delete();//borro valoraciones
            DB::table('plato')->where('menu_id', $id)->delete();//borro platos
            $sql=DB::table('menu')->where('id', $id)->delete();//finalmente borro menu
            return back()->with("menu_correcto","Menu eliminado correctamente.");
        }
        catch(Exception $e){ 
            error_log("error= " . $e->getMessage());
            return back()->with("menu_incorrecto","Error, ". $e->getMessage());
        }
    }

    public function delPlato($id){
        error_log("Eliminando al plato " . $id);
        try{ 
            $sql=DB::delete("delete from plato where id='$id'");
            return back()->with("plato_correcto","Plato eliminado correctamente.");

        }
        catch(Exception $e){ 
            error_log("error= " . $e->getMessage());
            return back()->with("plato_incorrecto","Error, ". $e->getMessage());
        }
    } 

    public function crearPlato(Request $request){

        //error_log(json_encode($request->all())); //PARA VER EL ARRAY DEL REQUEST

        $max_platos = 5;
        $platos = Plato::where('menu_id', $request->menu_id)->get();

        if(count($platos) >= $max_platos){
            return back()->with("plato_incorrecto","Error, solo puedes tener ". str($max_platos) . " platos por menú.");
        }


        try{ 
                    
            $validated = $request->validate([
                'nombre' => 'required|string|max:20',
                'descripcion' => 'nullable|string|max:20',
                'img' => 'nullable|string|max:20',
                'menu_id' => 'required|integer',
            ]); 

            $sql= Plato::create($validated);

            return back()->with("plato_correcto","Plato creado correctamente.");

        }
        catch(Exception $e){ 
            error_log("error= " . $e->getMessage());
            return back()->with("plato_incorrecto","Error, ". $e->getMessage());
        }

    }

    public function modMenu(Request $request){

        try{ 

            $request->validate([
                'nombre' => 'required|string|max:30',
                'descripcion' => 'string|max:500',
                'precio' => 'required|numeric',
                'restaurante_id' => 'required|integer|exists:restaurante,id',
                'img' => 'nullable|image',
            ]);
            Menu::where('id', $request->id)
                ->update([
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'precio' => $request->precio,
                    'restaurante_id' => $request->restaurante_id,
                    'img' => $request->img
                ]);

            return back()->with("plato_correcto","Menu modificado correctamente.");

        }catch(Exception $e){ 

            error_log("error= " . $e->getMessage());
            return back()->with("plato_incorrecto","Error, ". $e->getMessage());
       
        }
    }

    public function delValoracion($id){
      //  error_log("Eliminando a " . $id);

        try{ 
            $sql=DB::table('valoracion')->where('id', $id)->delete();
            return back()->with("valoracion_correcto","Valoracion eliminada correctamente.");
        }
        catch(Exception $e){ 
            error_log("error= " . $e->getMessage());
            return back()->with("valoracion_incorrecto","Error, ". $e->getMessage());
        }
    }

    public function actualizarValoracion(Request $request){
        $valor = intval($request->valoracion);
        $valor++;
        try{
            Valoracion::where('menu_id', $request->menuId)->update(['puntuacion' => $valor]);
            return response()->json("Status: Success");
        } catch(Exception $e) {
            return response()->json("Status: Error");
        }
    }

    public function crearValoracion(Request $request){
       // error_log("Creando valoracion");
       // error_log(json_encode($request->all())); //PARA VER EL ARRAY DEL REQUEST


        $max_valoraciones = 1;
        $valoraciones = Valoracion::where('menu_id', $request->id)
        ->where('users_id', auth()->user()->id)
        ->get();   

        if(count($valoraciones) >=  $max_valoraciones){
            return back()->with("valoracion_incorrecto","Error, solo puedes tener ". str($max_valoraciones) . " valoraciones por menú.");
        }

        try{ 
                    
            $validated = $request->validate([
                'comentario' => 'required|string|max:50',
                'puntuacion' => 'required|numeric|min:0|max:5',
                'users_id' => 'required',
                'menu_id' => 'required'
            ]); 

            Valoracion::create($validated);

            return back()->with("valoracion_correcto","Valoración creada correctamente.");

        }
        catch(Exception $e){ 
            error_log("error= " . $e->getMessage());
            return back()->with("valoracion_incorrecto","Error, ". $e->getMessage());
        }
    }

}
