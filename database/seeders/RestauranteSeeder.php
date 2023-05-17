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

        // Sample data arrays
        $nombres = ['La casa de paco', 'El jardín secreto', 'El bodegón', 'La taberna', 'La cantina', 'El rincón de la abuela', 'El asador', 'La brasserie', 'El mirador', 'El rincón de Pepe'];
        $direcciones = ['Calle Peru, 1', 'Avenida Argentina, 23', 'Plaza Mayor, 5', 'Calle Granada, 12', 'Paseo de la Castellana, 7', 'Calle San Miguel, 9', 'Calle Mayor, 2', 'Paseo de la Alameda, 11', 'Calle Valencia, 8', 'Calle Alcalá, 15'];
        $telefonos = [998456763, 986237419, 917543612, 925371864, 932456712, 941235678, 968743219, 956372841, 982364175, 971234568];
        $descripciones = ['La mejor comida mediterránea', 'Ambiente relajado y acogedor', 'Productos de la tierra y vinos selectos', 'Especialidades regionales y tapas', 'Cervezas artesanas y cócteles', 'Cocina tradicional con toques modernos', 'Asados y carnes a la brasa', 'Comida internacional y música en vivo', 'Vistas panorámicas de la ciudad', 'Platos caseros y postres de autor'];
        
        $images = ['paco.jpg','jardin.jpg','elbodegon.jpg','taberna.jpeg',
                    'lacantina.jpeg','rincon.jpg','elasador.jpg','labrasserie.jpg',
                    'mirador.jpg','pepe.jpg'];

        // Loop through the arrays and insert the data into the database
        for ($i = 0; $i < 10; $i++) {
            DB::table('restaurante')->insertOrIgnore([
                'nombre' => $nombres[$i],
                'direccion' => $direcciones[$i],
                'telefono' =>  $telefonos[$i],
                'descripcion' => $descripciones[$i],
                'img' => strval($i+1) . '|' .  $images[$i],
                'users_id' => 1
            ]);
        }
    }
}
