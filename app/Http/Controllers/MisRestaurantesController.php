<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MisRestaurantesController extends Controller
{ 
    public function mostrar($user_id){

        if(Auth::check()){

            $mis_restaurantes = Restaurante::where('id_user', '=', $user_id)->get();
            $mis_restaurantes_cont = count($mis_restaurantes);

            return view('panel_usuario/panel_mis_restaurantes')->with('mis_restaurantes',$mis_restaurantes)->with('mis_restaurantes_cont', $mis_restaurantes_cont);
        }else{
            return redirect('/login');
        }
    }
}
