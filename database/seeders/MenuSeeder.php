<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Restaurante;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //error_log(">>Seeding menu.");

        // Sample data arrays
        $nombres = ["Menú degustación", "Menú del día", "Menú infantil", "Menú vegetariano", "Menú para eventos", "Menú de mariscos", "Menú de carnes", "Menú de postres", "Menú de tapas", "Menú de sushi"];
        $descripciones = ["Prueba lo mejor de nuestra cocina en una selección de platos", "Disfruta de un menú completo a un precio excepcional", "Especialmente diseñado para los más pequeños de la casa", "Una opción deliciosa y saludable para los amantes de las verduras", "Personaliza tu evento con una selección de platos a medida", "Degusta los mejores productos del mar en nuestro menú especial", "Carnes a la brasa, guarniciones y salsas que combinan a la perfección", "Termina tu comida con una selección de postres caseros", "Descubre una gran variedad de tapas tradicionales de nuestra cocina", "Sushi de la mejor calidad, fresco y sabroso"];
        
        $images = ["queso.jpg","menudeldia.jpg","menu-nino.jpg","fruta.jpg","dj.jpg",
        "mariscos.jpg", "menucarnes.jpg", "desserts.jpg", "tapas.jpg", "sushi.jpg"];

        // Loop through the arrays and insert the data into the database
        for ($i = 0; $i < 10; $i++) {

            DB::table('menu')->insertOrIgnore([
                'nombre' => $nombres[$i],
                'descripcion' => $descripciones[$i],
                'precio' => 25 + $i, // Increment the price by 1 for each menu
                'restaurante_id' => $i + 1,
                'img' => strval($i+1) . '|' .  $images[$i]
            ]);
        }
    }
}
