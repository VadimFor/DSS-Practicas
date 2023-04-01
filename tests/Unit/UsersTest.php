<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Models\Valoracion;
use App\Models\Restaurante;
use App\Models\Menu;

class UsersTest extends TestCase
{

    //METODO PARA COMPROBAR QUE UN USUARIO EXISTE
    public function test_exists_user()
    {
        //Inserto al usuario
        DB::table('users')->insertOrIgnore([
            'name' => 'testname',
            'email' => 'test@test.com',
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

        //compruebo que existe
        $this->assertDatabaseHas('users', [
            'name' => 'testname',
            'email' => 'test@test.com',
            'apellido' => "testapel",
            'telefono' => "999999999",
            'direccion' => "sanvi",
            'pais' => "españa",
            'provincia' => "alicante",
            'poblacion' => "sanvi",
            'cod_postal' => "0457",
            'is_admin' => false
        ]);
    }


    //METODO PARA COMPROBAR QUE UN USUARIO TIENE UNA VALORACION
    public function test_save_valoracion()
    {
        DB::table('users')->insertOrIgnore([
            'name' => 'testValoracion',
            'email' => 'testValoracion@testValoracion.com',
            'apellido' => "testSAVE",
            'password' => bcrypt("1234"),
            'telefono' => "999999999",
            'direccion' => "sanvi",
            'pais' => "españa",
            'provincia' => "alicante",
            'poblacion' => "sanvi",
            'cod_postal' => "0457",
            'is_admin' => false
        ]);
        DB::table('restaurante')->insertOrIgnore([
            'nombre' => "restaurante test",
            'direccion' => "ninguna",
            'telefono' =>  "565644457",
            'descripcion' => "ninguna",
            'img' => "",
            'users_id' =>  Users::where('email', 'testValoracion@testValoracion.com')->first()->id
        ]);
        DB::table('menu')->insertOrIgnore([
            'nombre' => "Menu de test",
            'descripcion' => "ninguna",
            'precio' => 9, 
            'restaurante_id' => Restaurante::where('nombre', 'restaurante test')->first()->id,
            'img' => ""
        ]);

        $user = Users::where('email', 'testValoracion@testValoracion.com')->first();

        $valoracion = new Valoracion;
        $valoracion->puntuacion = 5;
        $valoracion->comentario = 'Muy MAL sabor, me gusta!';
        $valoracion->users_id = $user->id;
        $valoracion->menu_id = Menu::where('nombre', 'Menu de test')->first()->id;
        
        $user->valoraciones()->save($valoracion);
    
        // Assert that the user has a valoracion
        $this->assertTrue($user->valoraciones->contains($valoracion));
    }

}
