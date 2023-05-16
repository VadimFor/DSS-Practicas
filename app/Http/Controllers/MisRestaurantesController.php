<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

use Illuminate\Http\Request;

class MisRestaurantesController extends Controller
{ 
    public function mostrar($users_id){

        if(Auth::check()){
            
            //saco los restaurantes SOLO del usuario logeado
            $restaurantes = Restaurante::where('users_id', '=', $users_id)->paginate(5, ['*'], 'restaurantes');
            $restaurantes_cont = Restaurante::where('users_id', '=', $users_id)->get()->count();

            return view('panel_usuario/panel_mis_restaurantes')->with('restaurantes',$restaurantes)->with('restaurantes_cont', $restaurantes_cont);
        }else{
            return redirect('/login');
        }
    }

    public function crear(Request $request){

        try{

            error_log("Creando foto restaurante: " . $request->img);

            $img = $request->img;

            if($request->img){
                $request->validate([
                    'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                if ($request->file()) {
                    $imageoriginalName =  $request->file('img')->getClientOriginalName();
                    $extension = $request->file('img')->getClientOriginalExtension();
                    $imageName =  $request->id . "|" . "restaurante." . $extension;
                    $filePath = $request->file('img')->storeAs('public/img/restaurante/', $imageName);

                    $img =  $imageName;
        
                    error_log("Modificando foto perfil: " . $imageoriginalName);
                }
                
            }

            Restaurante::create([
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'descripcion' => $request->descripcion,
                'img' => $img,
                'users_id' => $request->users_id
            ]);

            $sql=1;

        }catch(Exception $e){
            error_log($e->getMessage()); 
            $sql = 0;
            return back()->with("incorrecto","Error, restaurante no creado: " . $e->getMessage());
        }

        if($sql == true){ return back()->with("correcto","Restaurante creado correctamente");}
    }

    public function mod(Request $request){

        try{

            $img = $request->img;

            if($request->img){

                error_log("Modificando foto restaurante: " . $request->img);


                $request->validate([
                    'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                if ($request->file()) {
                    $imageoriginalName =  $request->file('img')->getClientOriginalName();
                    $extension = $request->file('img')->getClientOriginalExtension();
                    $imageName =  $request->id . "|" . "restaurante." . $extension;
                    $filePath = $request->file('img')->storeAs('public/img/restaurante/', $imageName);

                    $img =  $imageName;
        
                }  
            }

            Restaurante::where('id', $request->id)
            ->update([
                 'nombre' => $request->nombre,
                 'direccion' => $request->direccion,
                 'telefono' => $request->telefono,
                 'descripcion' => $request->descripcion,
                 'img' => $request->img,
                 'users_id' => $request->users_id
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

        $keywords = explode(' ', request('busqueda-restaurante')); //el value del input q ha escrito el usuario
        
        
        $search = DB::table('restaurante')
        ->where('users_id', '=', auth()->user()->id)
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('nombre', 'LIKE', "%$keyword%")
                    ->orWhere('direccion', 'LIKE', "%$keyword%")
                    ->orWhere('telefono', 'LIKE', "%$keyword%")
                    ->orWhere('descripcion', 'LIKE', "%$keyword%");
            }
        })
        ->get();

        return back()->with("search-restaurante", $search);   
    } 

    public function sort($columna){
        $columna_ordenada = DB::table('restaurante')->orderBy($columna)->get();
        return back()->with("sort-restaurantes", $columna_ordenada);
    }

    public function modfoto(Request $request){


        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        if ($request->file()) {
            $imageoriginalName =  $request->file('img')->getClientOriginalName();
            $extension = $request->file('img')->getClientOriginalExtension();
            $imageName =  $request->email . "|" . "perfil." . $extension;
            $filePath = $request->file('img')->storeAs('public/img/user/', $imageName);

            error_log("Modificando foto perfil: " . $imageoriginalName);

            DB::update(
                "Update users set img=? where email=?",
                [$imageName,$request->email]);

            // Store $imageName to the database if needed
    
            return back()
                ->with('successimg','Imagen subida correctamente.')
                ->with('img', $imageName);
        }
    }
}
