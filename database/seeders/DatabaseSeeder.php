<?php

// php artisan make:seeder DatabaseSeeder

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //se ejecuta según este orden (por las claves ajenas)
        $this->call(UsuarioSeeder::class);
        $this->call(RestauranteSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(PlatoSeeder::class);
        $this->call(ValoracionSeeder::class);
    }
}
