<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Type\NullType;

class PerfilController extends Controller
{
    public function mostrar(){

        if(Auth::check()){
            return view('panel_usuario/panel_perfil');
        }else{
            return redirect('/login');
        }
    }

    public function modPerfil(Request $request){

        error_log("Modificando a " .$request->email);
        try{

            $sql=DB::update(
            "Update users set name=?, apellido=?, telefono=?, direccion=?,pais=?,provincia=?,poblacion=?,cod_postal=? where email=?",
            [$request->name,$request->apellido,$request->telefono,$request->direccion,$request->pais,$request->provincia, $request->poblacion,$request->cod_postal , $request->email]);

            if($sql==0){  $sql=1;}

        }catch(\Throwable $th){
            $sql = 0;
        }

        if($sql == true){
            return back()->with("correcto","Usuario modificado correctamente");
        }else{
            return back()->with("incorrecto","Error, usuario no modificado");
        }
    }

    public function modfoto(Request $request){


        $request->validate([
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
