<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurante;
use App\Models\Menu;

class RestauranteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurante = new Restaurante();
        $restaurante->nombre = 'La casa de paco';
        $restaurante->direccion = 'Calle Peru, 1';
        $restaurante->telefono = 998456763;
        $restaurante->descripcion = 'La mejor comida mediterranea';
        $restaurante->save();

    }
}
