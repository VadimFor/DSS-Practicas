<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Menu;
use App\Models\Valoracion;
class ValoracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $valoracion = new Valoracion();
        //$valoracion->usuario_id =
        //$valoracion->menu_id =            
        $valoracion->puntuacion = 5;
        $valoracion->comentario = 'Muy buen sabor';
        $valoracion->save();
    }
}
