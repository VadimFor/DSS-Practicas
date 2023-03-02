<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function test_users()
    {
        $this->assertDatabaseHas('users', [
            'name' => 'testname',
            'email' => 'a@a.com',
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


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
