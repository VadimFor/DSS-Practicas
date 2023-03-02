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

        DB::table('menu')->insertOrIgnore([
            'nombre' => "Menu degustacion",
            'descripcion' => "Para disfrutar",
            'precio' =>  25,
            'restaurante_id' => Restaurante::where('nombre','=','La casa de paco')->first()->id,
            'img' => ""
        ]);
    }
}
