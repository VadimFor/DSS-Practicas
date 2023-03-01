<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function mostrar(){
        if (Auth::check()){return redirect('/home');}
        return view('registro');}

    public function registro(RegisterRequest $request){
        $user = User::create($request->validated()); #Llama al request e inserta si pasa mis validaciones
        return redirect('/login')->with('success', 'Cuenta creada correctamente. Logueate.');
    }
}
