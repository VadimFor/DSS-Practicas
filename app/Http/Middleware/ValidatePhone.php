<?php

namespace App\Http\Middleware;

use Closure;

class ValidatePhone
{
    public function handle($request, Closure $next)
    {
        $telefono = $request->input('telefono');

        // Verificar la longitud del número de teléfono
        if (strlen($telefono) !== 9) {
            return redirect()->back()->withErrors(['telefono' => 'El número de teléfono debe tener 9 dígitos.'])->withInput();
        }

        return $next($request);
    }
}
