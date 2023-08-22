<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Tratamiento;

class TratamientoControllerTest extends TestCase
{

    use RefreshDatabase; //para que se refresque la base de datos después de cada prueba en memoria

    public function test_get_tratamientos() {
        $response = $this->get('/tratamientos');
        $response->assertStatus(302);
    }

    public function test_destroy_tratamiento(){

        $tratamiento = Tratamiento::factory()->create();

        $response = $this->delete('tratamientos/'.$tratamiento->id);

        $response->assertStatus(302); //tratamiento
    }

    public function test_store_tratamiento(){
        
        //arrange
        $tratamientoData = Tratamiento::factory()->create()->toArray();

        //act
        $response = $this->post('tratamientos', $tratamientoData);

        //assert
        $this->assertDatabaseHas('tratamientos', $tratamientoData);
        $response->assertStatus(302); //tratamiento creado
    }

    public function test_update_tratamiento(){
        //arrange
        $tratamientoData = Tratamiento::factory()->create();

        //act
        $response = $this->patch('tratamientos/'. $tratamientoData->id, [
            'nombre' => 'Nuevo',
            'precio' => 100
        ]);

        //assert
        $this->assertDatabaseHas('tratamientos', $tratamientoData->toArray());
        $response->assertStatus(302); //tratamiento actualizado
    }

    
}
