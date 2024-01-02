<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paciente;
use App\Models\Odontograma;
use App\Models\OdontogramaDetalle;

class PresupuestoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_budgets_of_a_pacient()
    {
        $paciente = Paciente::factory()->create();
        Odontograma::factory()->count(3)->create([
            'paciente_id' => $paciente->id
        ]);
        $response = $this->get('presupuestos/' . $paciente->id);
        $response->assertStatus(302);
    }

    public function test_get_pdf_budget(){
        $odontograma = Odontograma::factory()->create();
        $response = $this->get('presupuestos/pdf/'.$odontograma->id);
        $response->assertStatus(200);
    }

    public function test_get_total_budget(){

        $odontograma = Odontograma::factory()->create();
        $odontograma_detalles = OdontogramaDetalle::factory()->count(3)->create([
            'odontograma_cabecera_id' => $odontograma->id
        ]);

        for( $i = 0; $i < count($odontograma_detalles); $i++ ){
            $this->post('detalleOdontogramas', $odontograma_detalles[$i]->toArray());
        }

        $this->assertDatabaseHas('odontograma_cabecera', [
            'id' => $odontograma->id,
            'total' => 0
        ]);
    }
}
