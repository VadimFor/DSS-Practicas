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
use Illuminate\Pagination\Paginator;



class AdminController extends Controller
{



    public function mostrar(){

        if(Auth::check()){

            //error_log("Mostrando panel de usuario admin");

            $users =  Users::paginate(5, ['*'], 'users');//DB::select('select * from users');
            $restaurantes = Restaurante::paginate(5, ['*'], 'restaurantes'); //DB::select('select * from restaurante');
            $menus = Menu::paginate(5, ['*'], 'menus');//DB::select('select * from menu');
            $platos = Plato::paginate(5, ['*'], 'platos');//B::select('select * from plato');

            $users_cont = count(Users::all());
            $menu_cont = count(Menu::all());
            $plato_cont = count(Plato::all());
            $restaurante_cont = count(Restaurante::all());
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




    public function buscar(Request $request){

        /* 1 PALABRA
        $busqueda = $request->input('busqueda');

        $search = Users::where('name', 'LIKE', "%$busqueda%")
                    ->orWhere('email', 'LIKE', "%$busqueda%")
                    ->orWhere('apellido', 'LIKE', "%$busqueda%")
                    ->orWhere('telefono', 'LIKE', "%$busqueda%")
                    ->orWhere('direccion', 'LIKE', "%$busqueda%")
                    ->orWhere('pais', 'LIKE', "%$busqueda%")
                    ->orWhere('provincia', 'LIKE', "%$busqueda%")
                    ->orWhere('poblacion', 'LIKE', "%$busqueda%")
                    ->orWhere('cod_postal', 'LIKE', "%$busqueda%")
                    ->get();


        return back()->with("search",$search); */


        // 2 PALABRAS

         if ($request->tabla == 'users'){

            $keywords = explode(' ', request('busqueda-users'));

            $search = Users::where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->orWhere('name', 'LIKE', "%$keyword%")
                        ->orWhere('email', 'LIKE', "%$keyword%")
                        ->orWhere('apellido', 'LIKE', "%$keyword%")
                        ->orWhere('telefono', 'LIKE', "%$keyword%")
                        ->orWhere('direccion', 'LIKE', "%$keyword%")
                        ->orWhere('pais', 'LIKE', "%$keyword%")
                        ->orWhere('provincia', 'LIKE', "%$keyword%")
                        ->orWhere('poblacion', 'LIKE', "%$keyword%")
                        ->orWhere('cod_postal', 'LIKE', "%$keyword%");
                }
            })
            ->get();

            // Pasar los resultados a la vista
            return back()->with("search-users", $search);

        }elseif($request->tabla == 'restaurante'){

            $keywords = explode(' ', request('busqueda-restaurante'));

            $search = DB::table('restaurante')
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

        }elseif($request->tabla == 'menu'){

            $keywords = explode(' ', request('busqueda-menu'));

            $search = DB::table('menu')->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->orWhere('nombre', 'LIKE', "%$keyword%")
                        ->orWhere('descripcion', 'LIKE', "%$keyword%")
                        ->orWhere('precio', 'LIKE', "%$keyword%")
                        ->orWhere('restaurante_id', 'LIKE', "%$keyword%")
                        ->orWhere('img', 'LIKE', "%$keyword%");
                }
            })->get();
        
            return back()->with("search-menu", $search);

        }elseif($request->tabla == 'plato'){

            $keywords = explode(' ', request('busqueda-plato'));

            $search = DB::table('plato')->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->orWhere('nombre', 'LIKE', "%$keyword%")
                        ->orWhere('descripcion', 'LIKE', "%$keyword%")
                        ->orWhere('menu_id', 'LIKE', "%$keyword%")
                        ->orWhere('img', 'LIKE', "%$keyword%");
                }
            })->get();
        
            return back()->with("search-plato", $search);
    
        }

    }
    
}
