<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\ValidatePhone;

class RegisterController extends Controller
{
    public function mostrar(){
        if (Auth::check()){return redirect('/');}
        return view('registro');}

        public function registro(RegisterRequest $request)
        {
            // Verificar el teléfono utilizando el middleware directamente en el controlador
            $verificarTelefono = new ValidatePhone();
            $response = $verificarTelefono->handle($request, function ($request) {
                return $this->crearUsuario($request);
            });
    
            // Verificar si el middleware redirecciona con un error
            if ($response instanceof \Illuminate\Http\RedirectResponse) {
                return $response;
            }
    
            return redirect('/login')->with('success', 'Cuenta creada correctamente. Logueate.');
        }
    
        private function crearUsuario($request)
        {
            $user = User::create($request->validated());
            return $user;
        }
}
