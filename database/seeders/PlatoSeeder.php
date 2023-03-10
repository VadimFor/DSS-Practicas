<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plato;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class PlatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //error_log(">>Seeding plato.");

        // Sample data arrays
        $nombres = ['Pez trucha', 'Solomillo a la parrilla', 'Ensalada César', 'Carpaccio de ternera', 'Pulpo a la gallega', 'Arroz caldoso con bogavante', 'Tacos al pastor', 'Pad Thai', 'Pizza Margarita', 'Tiramisú'];
        $descripciones = ['Del Mediterráneo', 'Con salsa de champiñones y guarnición de patatas', 'Con pollo crujiente, lechuga romana, crutones y aderezo César', 'Con parmesano, rúcula y aceite de oliva', 'A la brasa con aceite de pimentón', 'Con mariscos, arroz y caldo de pescado', 'De cerdo marinado con chile y piña', 'Fideos de arroz salteados con gambas, tofu y cacahuetes', 'Tomate, mozzarella y albahaca', 'Con bizcochos de soletilla, mascarpone y café'];
        $menu_ids = [1, 1, 2, 2, 3, 3, 4, 4, 5, 5];

        // Loop through the arrays and insert the data into the database
        for ($i = 0; $i < 10; $i++) {
            DB::table('plato')->insertOrIgnore([
                'nombre' => $nombres[$i],
                'descripcion' => $descripciones[$i],
                'menu_id' => $menu_ids[$i],
                'img' => ""
            ]);
        }
    }
}
