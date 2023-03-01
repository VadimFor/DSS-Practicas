<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Menu;
use App\Models\Valoracion;
use Illuminate\Support\Facades\DB;


class ValoracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //error_log(">>Seeding valoracion.");

        DB::table('valoracion')->insertOrIgnore([
            'puntuacion' => 5,
            'comentario' => 'Muy buen sabor',
            'usuario_id' => User::where('email','=','a@a.com')->first()->id,
            'menu_id' => Menu::where('nombre','=','Menu degustacion')->first()->id
        ]);

    }
}
