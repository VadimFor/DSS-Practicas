<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{

    public function show(){
        if (Auth::check()){return redirect('/home');}
        return view('auth.login');}

        
    public function login(LoginRequest $request){

        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)){ #no correcto (IMPORTANTE, Auth::validate necesia que la contraseña esté hasheada en la base de datos)
            error_log(json_encode($credentials) . ' ' .  'Login no correcto');
            return redirect()->to('/login')->withErrors('auth.failed');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        return $this->authenticated($request, $user);
    }


    public function authenticated(Request $request, $user){
        return redirect('/home');
    }

}
