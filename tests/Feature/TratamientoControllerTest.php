<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tratamiento;

class TratamientoControllerTest extends TestCase
{

    use RefreshDatabase; //para que se refresque la base de datos después de cada prueba en memoria

    public function test_get_tratamientos() {
        $response = $this->get('/tratamientos');
        $response->assertStatus(302);
    }

    public function test_store_tratamiento(){
        
        //arrange
        $this->withoutMiddleware();
        $tratamientoData = Tratamiento::factory()->make()->toArray();

        //act
        $response = $this->post('/tratamientos', $tratamientoData);

        //assert
        $this->assertDatabaseHas('tratamientos', $tratamientoData);
        $response->assertStatus(302); //tratamiento creado
    }

    public function test_update_tratamiento(){
        //arrange
        $this->withoutMiddleware();
        $tratamientoData = [
            'precio' => 1000
        ];

        //act
        $response = $this->patch('/tratamientos/1', $tratamientoData);

        //assert
        //$this->assertDatabaseHas('tratamientos', $tratamientoData);
        $response->assertStatus(302); //tratamiento actualizado
    }

    public function test_destroy_tratamiento(){
        $response = $this->delete('/tratamientos/1');
        $response->assertStatus(302); //tratamiento eliminado
        $this->assertDatabaseMissing('tratamientos', ['id' => '1']);
    }
}
