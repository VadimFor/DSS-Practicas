<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Type\NullType;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurante;
use App\Models\Menu;
use App\Models\Plato;
use App\Models\Users;



class AdminController extends Controller
{
    public function mostrar(){

        if(Auth::check()){

            //error_log("Mostrando panel de usuario admin");
            $users =  Users::all();//DB::select('select * from users');
            $restaurantes = Restaurante::all(); //DB::select('select * from restaurante');
            $menus = Menu::all();//DB::select('select * from menu');
            $platos = Plato::all();//B::select('select * from plato');

            $users_cont = count($users);
            $menu_cont = count($menus);
            $plato_cont = count($platos);
            $restaurante_cont = count($restaurantes);
            $valoracion_cont = count(DB::select('select * from valoracion'));
            //error_log(json_encode($users));

        return view('panel_usuario/panel_admin')->with("users",$users)->with("users_cont",$users_cont)->with("menu_cont",$menu_cont)->with("plato_cont",$plato_cont)
        ->with("restaurante_cont",$restaurante_cont)->with("valoracion_cont",$valoracion_cont)->with("restaurantes",$restaurantes)->with("menus",$menus)->with("platos",$platos);
        }else{
            return redirect('/login');
        }
    }

    public function crear(Request $request){

        try{
            if ($request->tabla == 'users'){
                if($request->email == ""){ return back()->with("incorrecto","Error al crear usuario, el email no puede ser vacio.");}
                //FORMA ALTERNATIVA: $sql=DB::insert("Insert into users(name,email,password) values(?,?,?)", [$request->name,$request->email,bcrypt($request->password)] );
                Users::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
            }elseif($request->tabla == 'restaurante'){
                //$sql=DB::insert("Insert into restaurante(nombre,direccion,telefono,descripcion,img) values(?,?,?,?,?)", [$request->nombre,$request->direccion,$request->telefono,$request->descripcion,$request->img] );
                Restaurante::create([
                    'nombre' => $request->nombre,
                    'direccion' => $request->direccion,
                    'telefono' => $request->telefono,
                    'descripcion' => $request->descripcion,
                    'img' => $request->img
                ]);
            }elseif($request->tabla == 'menu'){
                //$sql=DB::insert("Insert into menu(nombre,descripcion,precio,restaurante_id,img) values(?,?,?,?,?)", [$request->nombre,$request->descripcion,$request->precio,$request->restaurante_id,$request->img] );
                Menu::create([
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'precio' => $request->precio,
                    'restaurante_id' => $request->restaurante_id,
                    'img' => $request->img
                ]);
            }elseif($request->tabla == 'plato'){
                //$sql=DB::insert("Insert into plato(nombre,descripcion,menu_id,img) values(?,?,?,?)", [$request->nombre,$request->descripcion,$request->menu_id,$request->img]);  
                Plato::create([
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'menu_id' => $request->menu_id,
                    'img' => $request->img
                ]);     
            }

            $sql=1;

        }catch(\Illuminate\Database\QueryException $th){error_log($th); $sql = 0;}

        if($sql == true){ return back()->with("correcto","$request->tabla creado correctamente");}
        else{ return back()->with("incorrecto","Error, $request->tabla no creado");}

    }

    public function mod(Request $request){

        try{

            if ($request->tabla == 'users'){
                //FORMA ALTERNATIVA: $sql=DB::update("Update users set password=?, name=?, apellido=?, telefono=?, direccion=?,pais=?,provincia=?,poblacion=?,cod_postal=? where email=?",[bcrypt($request->password), $request->name,$request->apellido,$request->telefono,$request->direccion,$request->pais,$request->provincia, $request->poblacion,$request->cod_postal , $request->email]);
                Users::where('email', $request->email)
                    ->update([
                        'password' => bcrypt($request->password),
                        'name' => $request->name,
                        'apellido' => $request->apellido,
                        'telefono' => $request->telefono,
                        'direccion' => $request->direccion,
                        'pais' => $request->pais,
                        'provincia' => $request->provincia,
                        'poblacion' => $request->poblacion,
                        'cod_postal' => $request->cod_postal
                    ]);
  
            }elseif($request->tabla == 'restaurante'){
                //$sql=DB::update("Update restaurante set nombre=?, direccion=?, telefono=?, descripcion=?, img=? where id=?",[$request->nombre,$request->direccion,$request->telefono,$request->descripcion,$request->img, $request->id]);
                Restaurante::where('id', $request->id)
                   ->update([
                        'nombre' => $request->nombre,
                        'direccion' => $request->direccion,
                        'telefono' => $request->telefono,
                        'descripcion' => $request->descripcion,
                        'img' => $request->img
                    ]);

            }elseif($request->tabla == 'menu'){
                //$sql=DB::update("Update users set nombre=?, descripcion=?, precio=?, restaurante_id=?, img=? where id=?",[$request->nombre,$request->descripcion,$request->precio,$request->restaurante_id,$request->img, $request->id]);
                Menu::where('id', $request->id)
                    ->update([
                        'nombre' => $request->nombre,
                        'descripcion' => $request->descripcion,
                        'precio' => $request->precio,
                        'restaurante_id' => $request->restaurante_id,
                        'img' => $request->img
                    ]);
            }elseif($request->tabla == 'plato'){
                //$sql=DB::update("Update users set nombre=?, descripcion=?, img=?, menu_id=? where id=?",[$request->nombre,$request->descripcion,$request->img , $request->id]);
                Plato::where('id', $request->id)
                    ->update([
                        'nombre' => $request->nombre,
                        'descripcion' => $request->descripcion,
                        'img' => $request->img,
                        'menu_id' => $request->menu_id
                    ]);
            }
            $sql = 1;

        }catch(\Illuminate\Database\QueryException $th){error_log($th); $sql = 0;}

        if($sql == true){ return back()->with("correcto","$request->tabla modificado correctamente");}
        else{ return back()->with("incorrecto","Error, $request->tabla no modificado");}

    }

    //ＲＥＳＴＡＵＲＡＮＴＥＳ
    public function delRestaurante($id){
        error_log("Eliminando a " . $id);

        try{ $sql=DB::delete("delete from restaurante where id='$id'");
        }catch(\Throwable $th){ $sql = 0;}

        if($sql == true){ return back()->with("correcto","Restaurante $id eliminado correctamente");}
        else{ return back()->with("incorrecto","Error, restaurante $id no eliminado");}
    }
   
    //ＭＥＮＵＳ
    public function delMenu($id){
        error_log("Eliminando a " . $id);

        try{ $sql=DB::delete("delete from menu where id='$id'");
        }catch(\Throwable $th){ $sql = 0;}

        if($sql == true){ return back()->with("correcto","Menu $id eliminado correctamente");}
        else{ return back()->with("incorrecto","Error, menu $id no eliminado");}
    }

    //ＰＬＡＴＯＳ
    public function delPlato($id){
        error_log("Eliminando a " . $id);
        try{ $sql=DB::delete("delete from plato where id='$id'");
        }catch(\Throwable $th){ $sql = 0;}

        if($sql == true){ return back()->with("correcto","Plato $id eliminado correctamente");}
        else{ return back()->with("incorrecto","Error, plato $id no eliminado");}

    } 
    
    //ＵＳＥＲＳ
    public function delUsuario($email){
        error_log("Eliminando a " . $email);
        try{ $sql=DB::delete("delete from users where email='$email'");
        }catch(\Throwable $th){ $sql = 0;}

        if($sql == true){ return back()->with("correcto","Usuario $email eliminado correctamente");}
        else{ return back()->with("incorrecto","Error, usuario $email no eliminado");}
    }


}
