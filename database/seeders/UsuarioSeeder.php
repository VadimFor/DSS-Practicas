<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //error_log(">>Seeding users.");

        DB::table('users')->insertOrIgnore([
            'name' => 'testname',
            'email' => 'a@a.com',
            'apellido' => "testapel",
            'password' => bcrypt("1234"),
            'telefono' => "999999999",
            'direccion' => "sanvi",
            'pais' => "españa",
            'provincia' => "alicante",
            'poblacion' => "sanvi",
            'cod_postal' => "0457",
            'is_admin' => false
        ]);
    }
}
