<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Valoracion;
use App\Models\Menu;
use App\Models\Restaurante;

class HomeController extends Controller
{
     public function top(){
        
        $menus = Menu::select('menu.*')
        ->join('valoracion', 'menu.id', '=', 'valoracion.menu_id')
        ->selectRaw('AVG(valoracion.puntuacion) as promedio')
        ->groupBy('menu.id')
        ->orderByDesc('promedio')
        ->get();   
        
        $menus_cont = $menus->count();

        if($menus_cont > 1){
            $menu1 = $menus[0];
            $menu2 = $menus[1];
    
            $menus[0] = $menu2;
            $menus[1] = $menu1;
        }

    


        return view('welcome')->with("menus", $menus)->with("menus_cont", $menus_cont);
    }
}
