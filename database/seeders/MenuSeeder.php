<?php

namespace Database\Seeders;

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
        //
        $menu = new Menu();
        //$menu->restaurante_id = 
        $menu->nombre = 'Menu degustacion';
        $menu->descripcion = 'Para disfrutar';
        $menu->precio = 25;
        $menu->save();
    }
}
