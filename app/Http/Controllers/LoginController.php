<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{

    public function mostrar(){
        if (Auth::check()){return redirect('/panelusuario/perfil');}
        return view('login');}


    public function login(LoginRequest $request){

        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)){ # (IMPORTANTE, Auth::validate necesita que la contraseña esté hasheada en la base de datos)
            error_log(json_encode($credentials) . ' ' .  'Login no correcto');
            return redirect()->to('/login')->withErrors('Datos incorrectos');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        return redirect('/panelusuario/perfil');
    }
}
