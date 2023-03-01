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

        DB::table('plato')->insertOrIgnore([
            'nombre' => 'Menu degustacion',
            'descripcion' => 'Para disfrutar',
            'menu_id' =>  Menu::where('nombre','=','Menu degustacion')->first()->id
        ]);
    }
}
