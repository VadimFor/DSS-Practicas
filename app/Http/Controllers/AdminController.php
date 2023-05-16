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
use App\Models\Valoracion;
use Illuminate\Pagination\Paginator;



class AdminController extends Controller
{
    /*
    //METODO PARA MOSTRAR LAS TABLAS DE ADMIN EL LA HOME PAGE DE LA WEB (requerido entrega_2)
    public function mostrar_entrega2(){

        $users =  Users::paginate(5, ['*'], 'users');//DB::select('select * from users');
        $restaurantes = Restaurante::paginate(5, ['*'], 'restaurantes'); //DB::select('select * from restaurante');
        $menus = Menu::paginate(5, ['*'], 'menus');//DB::select('select * from menu');
        $platos = Plato::paginate(5, ['*'], 'platos');//B::select('select * from plato');
        $valoraciones = Valoracion::paginate(5, ['*'], 'valoraciones');//B::select('select * from plato');

        $users_cont = count(Users::all());
        $menu_cont = count(Menu::all());
        $plato_cont = count(Plato::all());
        $restaurante_cont = count(Restaurante::all());
        $valoracion_cont = count(DB::select('select * from valoracion'));

        return view('entrega2')->with("users",$users)->with("users_cont",$users_cont)->with("menu_cont",$menu_cont)->with("plato_cont",$plato_cont)
        ->with("restaurante_cont",$restaurante_cont)->with("valoracion_cont",$valoracion_cont)->with("restaurantes",$restaurantes)->with("menus",$menus)->with("platos",$platos)
        ->with("valoraciones",$valoraciones);

    }*/

    public function mostrar(){

        if(Auth::check()){

            //error_log("Mostrando panel de usuario admin");

            $users =  Users::paginate(5, ['*'], 'users');//DB::select('select * from users');
            $restaurantes = Restaurante::paginate(5, ['*'], 'restaurantes'); //DB::select('select * from restaurante');
            $menus = Menu::paginate(5, ['*'], 'menus');//DB::select('select * from menu');
            $platos = Plato::paginate(5, ['*'], 'platos');//B::select('select * from plato');
            $valoraciones = Valoracion::paginate(5, ['*'], 'valoraciones');//B::select('select * from plato');

            $users_cont = count(Users::all());
            $menu_cont = count(Menu::all());
            $plato_cont = count(Plato::all());
            $restaurante_cont = count(Restaurante::all());
            $valoracion_cont = count(DB::select('select * from valoracion'));
            //error_log(json_encode($users));

        return view('panel_usuario/panel_admin')->with("users",$users)->with("users_cont",$users_cont)->with("menu_cont",$menu_cont)->with("plato_cont",$plato_cont)
        ->with("restaurante_cont",$restaurante_cont)->with("valoracion_cont",$valoracion_cont)->with("restaurantes",$restaurantes)->with("menus",$menus)->with("platos",$platos)
        ->with("valoraciones",$valoraciones);
        }else{
            return redirect('/login');
        }
    }

    public function crear(Request $request){

        $validatedData = [];
        try{
            if ($request->tabla == 'users'){
                if($request->email == ""){ return back()->with("incorrecto","Error al crear usuario, el email no puede ser vacio.");}

                $validatedData = $request->validate([
                    'name' => 'max:255',
                    'email' => 'required|string|email|min:5|max:30|unique:users',
                    'password' => 'required|string|min:4|max:50',
                    'password_confirmation' => 'required|string|min:4|max:50|same:password'
                ]);
                $validatedData['password'] = bcrypt($validatedData['password']);

                /*
                Users::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);*/
                Users::create($validatedData);

            }elseif($request->tabla == 'restaurante'){
                $validatedData = $request->validate([
                    'nombre' => 'required|string|max:50',
                    'direccion' => 'required|string|max:100',
                    'telefono' => 'required|string|min:9|max:9',
                    'descripcion' => 'required|string|max:500',
                    'users_id' => 'required|integer|exists:users,id',
                    'img' => 'nullable|image',
                ]);
                Restaurante::create($validatedData);

            }elseif($request->tabla == 'menu'){
                $validatedData = $request->validate([
                    'nombre' => 'required|string|max:30',
                    'descripcion' => 'max:500',
                    'precio' => 'required|numeric',
                    'restaurante_id' => 'required|integer|exists:restaurante,id',
                    'img' => 'nullable|image',
                ]);
                Menu::create($validatedData);

            }elseif($request->tabla == 'plato'){
                $validatedData = $request->validate([
                    'nombre' => 'required|string|max:50',
                    'descripcion' => 'required|string|max:500',
                    'menu_id' => 'required|integer|exists:menu,id',
                    'img' => 'nullable|image',
                ]);  
                Plato::create($validatedData);
 
            }elseif($request->tabla == 'valoracion'){
                $validatedData = $request->validate([
                    'puntuacion' => 'required|integer|between:1,5',
                    'comentario' => 'max:100',
                    'menu_id' => 'required|integer|exists:menu,id',
                    'users_id' => 'required|integer|exists:users,id',
                ]);   
                Valoracion::create($validatedData);
            }

            $sql=1;

        }catch(\Illuminate\Database\QueryException $th){error_log($th); $sql = 0;}

        if($sql == true){ return back()->with("correcto","$request->tabla creado correctamente");}
        else{ return back()->with("incorrecto","Error, $request->tabla no creado");}

    }

    public function mod(Request $request){

        $validatedData = [];
        try{

            if ($request->tabla == 'users'){

  
                $request->validate([
                    'name' => 'max:255',
                    'password' => 'required|string|min:4|max:50',
                    'apellido' => 'string|max:50',
                    'telefono' =>'string|between:9,9',
                    'direccion' => 'string|max:50',
                    'pais' => 'string|max:50',
                    'provincia' => 'string|max:50',
                    'poblacion' =>'string|max:50',
                    'cod_postal' => 'string|max:50'
                ]);

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

                $request->validate([
                    'nombre' => 'required|string|max:50',
                    'direccion' => 'required|string|max:100',
                    'telefono' => 'required|string|min:9|max:9',
                    'descripcion' => 'required|string|max:500',
                    'users_id' => 'required|integer|exists:users,id',
                    'img' => 'nullable|image',
                ]);
                Restaurante::where('id', $request->id)
                   ->update([
                        'nombre' => $request->nombre,
                        'direccion' => $request->direccion,
                        'telefono' => $request->telefono,
                        'descripcion' => $request->descripcion,
                        'users_id' => $request->users_id,
                        'img' => $request->img
                    ]);

            }elseif($request->tabla == 'menu'){
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
            }elseif($request->tabla == 'plato'){
                $request->validate([
                    'nombre' => 'required|string|max:50',
                    'descripcion' => 'required|string|max:500',
                    'menu_id' => 'required|integer|exists:menu,id',
                    'img' => 'nullable|image',
                ]);  
                Plato::where('id', $request->id)
                    ->update([
                        'nombre' => $request->nombre,
                        'descripcion' => $request->descripcion,
                        'img' => $request->img,
                        'menu_id' => $request->menu_id
                    ]);
            }elseif($request->tabla == 'valoracion'){
                $request->validate([
                    'puntuacion' => 'required|integer|between:1,5',
                    'comentario' => 'string|max:500',
                    'menu_id' => 'required|integer|exists:menu,id',
                    'users_id' => 'required|integer|exists:users,id',
                ]);  
                Valoracion::where('id', $request->id)
                ->update([
                    'puntuacion' => $request->puntuacion,
                    'comentario' => $request->comentario,
                    'menu_id' => $request->menu_id,
                    'users_id' => $request->users_id
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
        else{ return back()->with("incorrecto","Error, restaurante $id no eliminado (revisa las dependencias con otras tablas)");}
    }
   
    //ＭＥＮＵＳ
    public function delMenu($id){
        error_log("Eliminando a " . $id);

        try{ $sql=DB::delete("delete from menu where id='$id'");
        }catch(\Throwable $th){ $sql = 0;}

        if($sql == true){ return back()->with("correcto","Menu $id eliminado correctamente");}
        else{ return back()->with("incorrecto","Error, menu $id no eliminado (revisa las dependencias con otras tablas)");}
    }

    //ＰＬＡＴＯＳ
    public function delPlato($id){
        error_log("Eliminando a " . $id);
        try{ $sql=DB::delete("delete from plato where id='$id'");
        }catch(\Throwable $th){ $sql = 0;}

        if($sql == true){ return back()->with("correcto","Plato $id eliminado correctamente");}
        else{ return back()->with("incorrecto","Error, plato $id no eliminado (revisa las dependencias con otras tablas)");}

    } 
    
    //ＵＳＥＲＳ
    public function delUsuario($email){
        error_log("Eliminando a " . $email);
        try{ $sql=DB::delete("delete from users where email='$email'");
        }catch(\Throwable $th){ $sql = 0;}

        if($sql == true){ return back()->with("correcto","Usuario $email eliminado correctamente");}
        else{ return back()->with("incorrecto","Error, usuario $email no eliminado (revisa las dependencias con otras tablas)");}
    }


    //ＶＡＬＯＲＡＣＩＯＮＥＳ
    public function delValoracion($id){
        error_log("Eliminando a valoración " . $id);
        try{ $sql=DB::delete("delete from valoracion where id='$id'");
        }catch(\Throwable $th){ $sql = 0;}

        if($sql == true){ return back()->with("correcto","Valoración $id eliminado correctamente");}
        else{ return back()->with("incorrecto","Error, valoracion $id no eliminado (revisa las dependencias con otras tablas)");}
    }


    public function buscar(Request $request){

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

        }elseif($request->tabla == 'valoracion'){

            $keywords = explode(' ', request('busqueda-valoracion'));

            $search = DB::table('valoracion')->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->orWhere('puntuacion', 'LIKE', "%$keyword%")
                        ->orWhere('comentario', 'LIKE', "%$keyword%");
                }
            })->get();
        
            return back()->with("search-valoracion", $search);
        }
    }


    public function sort($tablacolumna){

        if (strpos($tablacolumna, 'users') !== false){
            $aux = str_replace('users-', "", $tablacolumna);
            $columna_ordenada = DB::table('users')->orderBy($aux)->get();

            return back()->with("sort-users", $columna_ordenada);

        }elseif(strpos($tablacolumna, 'restaurantes') !== false){

            $aux = str_replace('restaurantes-', "", $tablacolumna);
            $columna_ordenada = DB::table('restaurante')->orderBy($aux)->get();

            return back()->with("sort-restaurantes", $columna_ordenada);

        }elseif(strpos($tablacolumna, 'menus') !== false){

            $aux = str_replace('menus-', "", $tablacolumna);
            $columna_ordenada = DB::table('menu')->orderBy($aux)->get();

            return back()->with("sort-menus", $columna_ordenada);

        }elseif(strpos($tablacolumna, 'platos') !== false){

            $aux = str_replace('platos-', "", $tablacolumna);
            $columna_ordenada = DB::table('plato')->orderBy($aux)->get();

            return back()->with("sort-platos", $columna_ordenada);

        }elseif(strpos($tablacolumna, 'valoraciones') !== false){

            $aux = str_replace('valoraciones-', "", $tablacolumna);
            $columna_ordenada = DB::table('valoracion')->orderBy($aux)->get();

            return back()->with("sort-valoraciones", $columna_ordenada);
        }
    }
    
}
