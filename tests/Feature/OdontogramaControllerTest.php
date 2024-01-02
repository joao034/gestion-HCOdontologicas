<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Odontograma;
use App\Models\OdontogramaDetalle;
use App\Models\Paciente;
use App\Models\Tratamiento;
use App\Models\Odontologo;
use App\Models\Simbolo;

use Tests\TestCase;

class OdontogramaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_odontograms_of_a_pacient()
    {
        $paciente = Paciente::factory()->create();
        Odontograma::factory()->count(3)->create([
            'paciente_id' => $paciente->id
        ]);

        $response = $this->get('odontogramas/' . $paciente->id);

        $response->assertStatus(302);
    }

    public function test_create_odontogram()
    {
        $odontogramaData = Odontograma::factory()->create();

        $response = $this->post('odontogramas/nuevo/' .$odontogramaData->paciente_id , $odontogramaData->toArray()); 

        $this->assertDatabaseHas('odontograma_cabecera', $odontogramaData->toArray());
        $response->assertStatus(302); 
    }

    public function test_create_odontogram_detail(){

        $odontogramaDetalle = OdontogramaDetalle::factory()->create()->toArray();

        $response = $this->post('detalleOdontogramas', $odontogramaDetalle);

        $this->assertDatabaseHas('odontograma_detalle', $odontogramaDetalle);
        $response->assertStatus(302); 
    }

    public function test_delete_odontogram_detail(){
        $odontogramaDetalle = OdontogramaDetalle::factory()->create();

        $response = $this->delete('detalleOdontogramas/'.$odontogramaDetalle->id);
        
        $response->assertStatus(302);
    }
}
