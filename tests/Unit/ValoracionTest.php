<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Menu;

class ValoracionTest extends TestCase
{

    public function test_valoracion()
    {
        $this->assertDatabaseHas('valoracion', [
            'puntuacion' => 5,
            'comentario' => 'Muy buen sabor',
            'usuario_id' => User::where('email','=','a@a.com')->first()->id,
            'menu_id' => Menu::where('nombre','=','Menu degustacion')->first()->id
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
