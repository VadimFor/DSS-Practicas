<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD:database/seeders/UsuarioSeeder.php
        $usuario2 = new User();
        $usuario2->email = 'a@a.com';
        $usuario2->password = '1234';

        $usuario2->name = 'vadim';
        $usuario2->apellido = 'test';
        $usuario2->telefono = 'test';
        $usuario2->direccion = 'test';
        $usuario2->pais = 'test';
        $usuario2->provincia = 'test';
        $usuario2->poblacion = 'test';
        $usuario2->cod_postal = 'test';

        $usuario2->save();

=======
        //
        $user = new User();
        $user->name = 'Pepe';
        $user->email = 'pepito@gmail.com';
        $user->password = '1234';
        $user->save();
        
>>>>>>> cd3d180c4bf365019de25fc9a7e8b2a064f50244:database/seeders/UserSeeder.php
    }
}
