<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;

class RestaurantesController extends Controller
{

    public function mostrar(){


        $restaurantes = Restaurante::all();

        return view('restaurantes')->with("restaurantes",$restaurantes);


    }
    
}
