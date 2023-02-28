<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plato;
use App\Models\Menu;
class PlatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $plato = new Plato();
        $plato->nombre = 'Calamares fritos';
        $plato->descripcion = 'Calamares fritos en tempura';
        $menu = Menu::where('nombre','=','Menu degustacion');
        $plato->menu()->associate($menu->id);
        $plato->save();
    }
}
