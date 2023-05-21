<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use App\Models\Restaurante;
class CheckRestaurantExists
{
    public function handle($request, Closure $next)
    {
        $errorMessage = 'No hay restaurantes creados.';
        if (!Restaurante::exists()) {
            // No hay restaurantes creados, mostrar mensaje de error
            return redirect()->back()->withErrors(['No hay restaurantes creados.'])
                                  ->withInput()
                                  ->with('error-message', $errorMessage)
                                  ->with('error-timeout', true);
        }

        return $next($request);
    }
}