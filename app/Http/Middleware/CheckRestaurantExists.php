<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use App\Models\Restaurante;
use App\Models\Menu;
class CheckExists
{
    public function handle($request, Closure $next)
    {
        $errorMessage = 'No hay elementos creados aun.';
        if (!Restaurante::exists() || !Menu::exists()) {
            // No hay restaurantes creados, mostrar mensaje de error
            return redirect()->back()->withErrors(['No hay elementos creados aun.'])
                                  ->withInput()
                                  ->with('error-message', $errorMessage)
                                  ->with('error-timeout', true);
        }

        return $next($request);
    }
}