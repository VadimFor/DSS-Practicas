<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Type\NullType;

class HomeController extends Controller
{
    public function mostrar(){

        error_log("Mostrando panel de usuario");
        $users = DB::select('select * from users');
        $users_cont = count($users);
        $menu = count(DB::select('select * from menu'));
        $plato = count(DB::select('select * from plato'));
        $restaurante = count(DB::select('select * from restaurante'));
        $valoracion = count(DB::select('select * from valoracion'));
        error_log(json_encode($users));

        return view('panelusuario')->with("users",$users)->with("users_cont",$users_cont)->with("menu",$menu)->with("plato",$plato)->with("restaurante",$restaurante)->with("valoracion",$valoracion);
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

    public function crearUsuario(Request $request){
        //return $request->name;   coje el name de: <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="">
        if($request->email == ""){
            return back()->with("incorrecto","Error al crear usuario, el email no puede ser vacio.");
        }

        try{
            $sql=DB::insert("Insert into users(name,email,password) values(?,?,?)", [
                $request->name,
                $request->email,
                bcrypt($request->password)
            ] );
        }catch(\Throwable $th){
            $sql = 0;
        }

        if($sql == true){
            return back()->with("correcto","Usuario creado correctamente");
        }else{
            return back()->with("incorrecto","Error, usuario no creado");
        }
    }


    public function modUsuario(Request $request){

        try{

            $sql=DB::update(
            "Update users set password=?, name=?, apellido=?, telefono=?, direccion=?,pais=?,provincia=?,poblacion=?,cod_postal=? where email=?",
            [bcrypt($request->password), $request->name,$request->apellido,$request->telefono,$request->direccion,$request->pais,$request->provincia, $request->poblacion,$request->cod_postal , $request->email]);

            if($sql==0){  $sql=1;}

        }catch(\Throwable $th){
            $sql = 0;
        }


        if($sql == true){ return back()->with("correcto","Usuario modificado correctamente");}
        else{ return back()->with("incorrecto","Error, usuario no modificado");}
    }


    public function delUsuario($email){
        error_log("Eliminando a " . $email);
        try{
            $sql=DB::delete("delete from users where email='$email'");
        }catch(\Throwable $th){
            $sql = 0;
        }

        if($sql == true){ return back()->with("correcto","Usuario $email eliminado correctamente");}
        else{ return back()->with("incorrecto","Error, usuario $email no eliminado");}
    }
}
