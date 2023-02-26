<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $usuario = new Usuario();
        $usuario->name = 'Pepe';
        $usuario->email = 'pepito@gmail.com';
        $usuario->password = '1234';
        $usuario->save();
        
    }
}
