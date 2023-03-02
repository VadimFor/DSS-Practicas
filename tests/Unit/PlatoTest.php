<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Menu;

class PlatoTest extends TestCase
{

    public function test_plato()
    {
        $this->assertDatabaseHas('plato', [
            'nombre' => 'Menu degustacion',
            'descripcion' => 'Para disfrutar',
            'menu_id' => Menu::where('nombre','=','Menu degustacion')->first()->id,
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
