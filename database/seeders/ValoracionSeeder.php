<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users;
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
            'comentario' => ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem commodi laborum, aliquam sed natus labore repudiandae fugit dignissimos totam esse sunt nemo corrupti, modi magnam quasi aspernatur nihil. Ipsum, exercitationem?',
            'users_id' => Users::where('email','=','a@a.com')->first()->id,
            'menu_id' => Menu::where('nombre','=','Menu degustacion')->first()->id
        ]);

        DB::table('valoracion')->insertOrIgnore([
            'puntuacion' => 4,
            'comentario' => ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem commodi laborum, aliquam sed natus labore repudiandae fugit dignissimos totam esse sunt nemo corrupti, modi magnam quasi aspernatur nihil. Ipsum, exercitationem?',
            'users_id' => Users::where('email','=','a@a.com')->first()->id,
            'menu_id' => Menu::where('nombre','=','Menú del día')->first()->id
        ]);

        DB::table('valoracion')->insertOrIgnore([
            'puntuacion' => 3,
            'comentario' => ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem commodi laborum, aliquam sed natus labore repudiandae fugit dignissimos totam esse sunt nemo corrupti, modi magnam quasi aspernatur nihil. Ipsum, exercitationem?',
            'users_id' => Users::where('email','=','a@a.com')->first()->id,
            'menu_id' => Menu::where('nombre','=','Menú vegetariano')->first()->id
        ]);

        DB::table('valoracion')->insertOrIgnore([
            'puntuacion' => 2,
            'comentario' => ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem commodi laborum, aliquam sed natus labore repudiandae fugit dignissimos totam esse sunt nemo corrupti, modi magnam quasi aspernatur nihil. Ipsum, exercitationem?',
            'users_id' => Users::where('email','=','a@a.com')->first()->id,
            'menu_id' => Menu::where('nombre','=','Menú para eventos')->first()->id
        ]);

        DB::table('valoracion')->insertOrIgnore([
            'puntuacion' => 1,
            'comentario' => ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem commodi laborum, aliquam sed natus labore repudiandae fugit dignissimos totam esse sunt nemo corrupti, modi magnam quasi aspernatur nihil. Ipsum, exercitationem?',
            'users_id' => Users::where('email','=','a@a.com')->first()->id,
            'menu_id' => Menu::where('nombre','=','Menú de mariscos')->first()->id
        ]);

        DB::table('valoracion')->insertOrIgnore([
            'puntuacion' => 1,
            'comentario' => ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem commodi laborum, aliquam sed natus labore repudiandae fugit dignissimos totam esse sunt nemo corrupti, modi magnam quasi aspernatur nihil. Ipsum, exercitationem?',
            'users_id' => Users::where('email','=','a@a.com')->first()->id,
            'menu_id' => Menu::where('nombre','=','Menú de carnes')->first()->id
        ]);

        DB::table('valoracion')->insertOrIgnore([
            'puntuacion' => 5,
            'comentario' => ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem commodi laborum, aliquam sed natus labore repudiandae fugit dignissimos totam esse sunt nemo corrupti, modi magnam quasi aspernatur nihil. Ipsum, exercitationem?',
            'users_id' => Users::where('email','=','a@a.com')->first()->id,
            'menu_id' => Menu::where('nombre','=','Menú infantil')->first()->id
        ]);

        DB::table('valoracion')->insertOrIgnore([
            'puntuacion' => 3,
            'comentario' => ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem commodi laborum, aliquam sed natus labore repudiandae fugit dignissimos totam esse sunt nemo corrupti, modi magnam quasi aspernatur nihil. Ipsum, exercitationem?',
            'users_id' => Users::where('email','=','a@a.com')->first()->id,
            'menu_id' => Menu::where('nombre','=','Menú de tapas')->first()->id
        ]);

        DB::table('valoracion')->insertOrIgnore([
            'puntuacion' => 2,
            'comentario' => ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem commodi laborum, aliquam sed natus labore repudiandae fugit dignissimos totam esse sunt nemo corrupti, modi magnam quasi aspernatur nihil. Ipsum, exercitationem?',
            'users_id' => Users::where('email','=','a@a.com')->first()->id,
            'menu_id' => Menu::where('nombre','=','Menú de postres')->first()->id
        ]);

        DB::table('valoracion')->insertOrIgnore([
            'puntuacion' => 4,
            'comentario' => ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem commodi laborum, aliquam sed natus labore repudiandae fugit dignissimos totam esse sunt nemo corrupti, modi magnam quasi aspernatur nihil. Ipsum, exercitationem?',
            'users_id' => Users::where('email','=','a@a.com')->first()->id,
            'menu_id' => Menu::where('nombre','=','Menú de sushi')->first()->id
        ]);
        



    }
}
