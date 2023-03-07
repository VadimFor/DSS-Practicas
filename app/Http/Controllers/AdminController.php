<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Type\NullType;


class AdminController extends Controller
{
    public function mostrar(){

        if(Auth::check()){

            error_log("Mostrando panel de usuario");
            $users = DB::select('select * from users');
            $restaurantes = DB::select('select * from restaurante');
            $menus = DB::select('select * from menu');
            $platos = DB::select('select * from plato');

            $users_cont = count($users);
            $menu_cont = count($menus);
            $plato_cont = count($platos);
            $restaurante_cont = count($restaurantes);
            $valoracion_cont = count(DB::select('select * from valoracion'));
            error_log(json_encode($users));

        return view('panel_usuario/panel_admin')->with("users",$users)->with("users_cont",$users_cont)->with("menu_cont",$menu_cont)->with("plato_cont",$plato_cont)
        ->with("restaurante_cont",$restaurante_cont)->with("valoracion_cont",$valoracion_cont)->with("restaurantes",$restaurantes)->with("menus",$menus)->with("platos",$platos);
        }else{
            return redirect('/login');
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
