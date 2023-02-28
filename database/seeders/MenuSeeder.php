<?php

namespace Database\Seeders;

use App\Models\Restaurante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menu();        
        $menu->nombre = 'Menu degustacion';
        $menu->descripcion = 'Para disfrutar';
        $menu->precio = 25;
        $restaurante = Restaurante::where('nombre','=','La casa de paco');
        $menu->restaurante()->associate($restaurante->id);
        $menu->save();
    }
}
