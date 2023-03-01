<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurante;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class RestauranteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //error_log(">>Seeding restaurante.");

        DB::table('restaurante')->insertOrIgnore([
            'nombre' => 'La casa de paco',
            'direccion' => 'Calle Peru, 1',
            'telefono' =>  998456763,
            'descripcion' => 'La mejor comida mediterranea',
        ]);

    }
}
