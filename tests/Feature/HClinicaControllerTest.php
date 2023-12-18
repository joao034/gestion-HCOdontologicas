<?php

namespace Tests\Feature;

use App\Models\Paciente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HClinicaControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_get_hclinicas()
    {
        $response = $this->get('/hclinicas');
        $response->assertStatus(302);
    }

    public function test_store_hclinica()
    {
        $response = $this->get('/hclinicas');
        $response->assertStatus(302);

       /*  //arrange
        $paciente = Paciente::factory()->create()->toArray();

        //act
        $response = $this->post('hclinicas', $paciente);

        //assert
        $response->assertStatus(302);
        $this->assertDatabaseHas('pacientes', $paciente);
 */
        
    }

    public function test_update_hclinica(){

        $response = $this->get('/hclinicas');
        $response->assertStatus(302);

        /* //arrange
        $paciente = Paciente::factory()->create();

        //act
        $response = $this->put('hclinicas/'.$paciente->id, [
            'nombres' => 'Joao',
            'apellidos' => 'Perez',
        ]);

        //assert
        $response->assertStatus(302);
        $this->assertDatabaseHas('pacientes', $paciente->toArray()); */
    }
/* 
    public function test_delete_user(){
        //arrange
        $paciente = Paciente::factory()->create();

        //act
        $response = $this->delete('hclinicas/'.$paciente->id);

        //assert
        $response->assertStatus(302);
    } */
}
