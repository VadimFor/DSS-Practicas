<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RestauranteTest extends TestCase
{

    public function test_restaurante()
    {
        $this->assertDatabaseHas('restaurante', [
            'nombre' => 'La casa de paco',
            'direccion' => 'Calle Peru, 1',
            'telefono' => 998456763,
            'descripcion' => 'La mejor comida mediterranea',
            'img' => ''
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
