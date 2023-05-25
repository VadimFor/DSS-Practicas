<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class RestaurantesController extends Controller
{

    public function mostrar(){
        $restaurantes = Restaurante::select('*')->paginate(4, ['*'],'restaurantes');

        return view('restaurantes')->with("restaurantes",$restaurantes);

    }

    public function buscar(Request $request){

        $keywords = explode(' ', request('busqueda-restaurante')); //el value del input q ha escrito el usuario

        $search = DB::table('restaurante')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('nombre', 'LIKE', "%$keyword%")
                    ->orWhere('direccion', 'LIKE', "%$keyword%")
                    ->orWhere('telefono', 'LIKE', "%$keyword%")
                    ->orWhere('descripcion', 'LIKE', "%$keyword%");
            }
        })
        ->get();

        return back()->with("search-restaurante", $search);   
    } 
    
}
