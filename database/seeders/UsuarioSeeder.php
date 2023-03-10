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

        // Define arrays with test data
        $names = ['John', 'Mary', 'David', 'Sarah', 'Robert', 'Julia', 'Michael', 'Emily', 'Steven', 'Jessica'];
        $emails = ['john@example.com', 'mary@example.com', 'david@example.com', 'sarah@example.com', 'robert@example.com', 'julia@example.com', 'michael@example.com', 'emily@example.com', 'steven@example.com', 'jessica@example.com'];
        $apellidos = ['Doe', 'Johnson', 'Smith', 'Brown', 'Garcia', 'Miller', 'Davis', 'Anderson', 'Wilson', 'Martinez'];
        $telefonos = ['111111111', '222222222', '333333333', '444444444', '555555555', '666666666', '777777777', '888888888', '999999999', '000000000'];
        $direcciones = ['Street 1', 'Street 2', 'Street 3', 'Street 4', 'Street 5', 'Street 6', 'Street 7', 'Street 8', 'Street 9', 'Street 10'];
        $paises = ['Spain', 'USA', 'Canada', 'UK', 'France', 'Germany', 'Italy', 'Mexico', 'Brazil', 'China'];
        $provincias = ['Alicante', 'Madrid', 'Barcelona', 'Valencia', 'Malaga', 'Sevilla', 'Murcia', 'Cadiz', 'Granada', 'Tenerife'];
        $poblaciones = ['Sanvi', 'Madrid', 'Barcelona', 'Valencia', 'Malaga', 'Sevilla', 'Murcia', 'Cadiz', 'Granada', 'Tenerife'];
        $codigos_postales = ['03110', '28001', '08001', '46001', '29001', '41001', '30001', '11001', '18001', '38001'];

        // Insert 10 rows with the data from the arrays
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insertOrIgnore([
                'name' => $names[$i],
                'email' => $emails[$i],
                'apellido' => $apellidos[$i],
                'password' => bcrypt("1234"),
                'telefono' => $telefonos[$i],
                'direccion' => $direcciones[$i],
                'pais' => $paises[$i],
                'provincia' => $provincias[$i],
                'poblacion' => $poblaciones[$i],
                'cod_postal' => $codigos_postales[$i],
                'is_admin' => false
            ]);
}

        
    }
}
