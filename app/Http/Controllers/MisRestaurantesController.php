<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class MisRestaurantesController extends Controller
{ 
    public function mostrar($user_id){

        if(Auth::check()){
            
            $mis_restaurantes = Restaurante::where('id_user', '=', $user_id)->paginate(5, ['*'], 'restaurantes');
            $mis_restaurantes_cont = Restaurante::where('id_user', '=', $user_id)->get()->count();

            return view('panel_usuario/panel_mis_restaurantes')->with('mis_restaurantes',$mis_restaurantes)->with('mis_restaurantes_cont', $mis_restaurantes_cont);
        }else{
            return redirect('/login');
        }
    }

    public function crear(Request $request){

        try{

            Restaurante::create([
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'descripcion' => $request->descripcion,
                'img' => $request->img,
                'id_user' => $request->id
            ]);

            $sql=1;

        }catch(\Illuminate\Database\QueryException $th){error_log($th); $sql = 0;}

        if($sql == true){ return back()->with("correcto","Restaurante creado correctamente");}
        else{ return back()->with("incorrecto","Error, restaurante no creado");}

    }

    public function mod(Request $request){
        try{
            Restaurante::where('id', $request->id)
            ->update([
                 'nombre' => $request->nombre,
                 'direccion' => $request->direccion,
                 'telefono' => $request->telefono,
                 'descripcion' => $request->descripcion,
                 'img' => $request->img
             ]);

             $sql=1;

        }catch(\Illuminate\Database\QueryException $th){error_log("Excepción en modificar restaurante"); $sql = 0;}

        if($sql == true){ return back()->with("correcto","Restaurante modificado correctamente");}
        else{ return back()->with("incorrecto","Error, restaurante no modificado");}
    }


    public function delRestaurante($id){
        error_log("Eliminando a " . $id);

        try{ 
            $sql=DB::delete("delete from restaurante where id='$id'");
            $sql=1;
        }catch(\Illuminate\Database\QueryException $th){error_log($th); $sql = 0;}

        if($sql == true){ return back()->with("correcto","Restaurante $id eliminado correctamente");}
        else{ return back()->with("incorrecto","Error, restaurante $id no eliminado. (Comprueba si es foreign key de algún menú)");}
    }

    public function buscar(Request $request){

        $id_user = $request->id;
    
        $keywords = explode(' ', request('busqueda-restaurante'));
    
        $search = DB::table('restaurante')
        ->where('id_user', '=', $id_user)
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('id', 'LIKE', "%$keyword%")
                    ->orWhere('nombre', 'LIKE', "%$keyword%")
                    ->orWhere('direccion', 'LIKE', "%$keyword%")
                    ->orWhere('telefono', 'LIKE', "%$keyword%")
                    ->orWhere('descripcion', 'LIKE', "%$keyword%")
                    ->orWhere('img', 'LIKE', "%$keyword%");
            }
        })
        ->get();
    
        return back()->with("search-restaurante", $search);   
    } 

    public function sort($columna){
        $columna_ordenada = DB::table('restaurante')->orderBy($columna)->get();
        return back()->with("sort-restaurantes", $columna_ordenada);
    }
}
