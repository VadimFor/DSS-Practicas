<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Restaurante;

class MenuTest extends TestCase
{

    public function test_menu()
    {
        $this->assertDatabaseHas('menu', [
            'nombre' => 'Menu degustacion',
            'descripcion' => 'Para disfrutar',
            'precio' => 25,
            'restaurante_id' => Restaurante::where('nombre','=','La casa de paco')->first()->id,
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
