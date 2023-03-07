<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResenyasController extends Controller
{
    public function mostrar(){

        if(Auth::check()){
            return view('panel_usuario/panel_resenyas');
        }else{
            return redirect('/login');
        }
    }


}
