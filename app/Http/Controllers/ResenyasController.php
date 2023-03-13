<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Usuario;
use App\Models\Valoracion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResenyasController extends Controller
{
    public function mostrar($usuario_id){

        if(Auth::check()){

            $mis_resenyas = Valoracion::select('valoracion.*', 'menu.nombre AS menu_nombre' , 'menu.precio', 'menu.img', 'restaurante.direccion AS dir')
            ->join('menu', 'valoracion.menu_id', '=', 'menu.id')
            ->join('restaurante', 'menu.restaurante_id', '=', 'restaurante.id')
            ->get();
            //error_log($mis_resenyas);

            //$mis_resenyas = Valoracion::where('usuario_id', '=', $usuario_id)->paginate(5, ['*'], 'resenyas');
            $mis_resenyas_cont = Valoracion::where('usuario_id', '=', $usuario_id)->get()->count();

            return view('panel_usuario/panel_resenyas')->with('mis_resenyas',$mis_resenyas)->with('mis_resenyas_cont', $mis_resenyas_cont);

        }else{
            return redirect('/login');
        }
    }


    public function delResenya($id){
        error_log("Eliminando a " . $id);

        try{ 
            $sql=DB::delete("delete from valoracion where id='$id'");
            $sql=1;
        }catch(\Throwable $th){ $sql = 0;}

        if($sql == true){ return back()->with("correcto","Reseña $id eliminada correctamente");}
        else{ return back()->with("incorrecto","Error, Reseña $id no eliminada");}
    }

    public function mod(Request $request){
        try{
            Valoracion::where('id', $request->id)
            ->update([
                'puntuacion' => $request->puntuacion,
                'comentario' => $request->comentario,
            ]);
            $sql=1;

        }catch(\Illuminate\Database\QueryException $th){error_log($th); $sql = 0;}

        if($sql == true){ return back()->with("correcto","Reseña modificada correctamente.");}
        else{ return back()->with("incorrecto","Error, reseña no modificada.");}

    }
}
