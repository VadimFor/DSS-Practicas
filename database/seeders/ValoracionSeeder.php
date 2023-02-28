<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
        $valoracion->puntuacion = 5;
        $valoracion->comentario = 'Muy buen sabor';
        $user = User::where('email','=','pepito@gmail.com');
        $menu = Menu::where('nombre','=','Menu degustacion');
        $valoracion->user()->associate($user->id);
        $valoracion->menu()->associate($menu->id);
        $valoracion->save();
    }
}
