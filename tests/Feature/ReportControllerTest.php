<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Odontograma;

class ReportControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_pacientes_por_odontologo(): void
    {
        //arrange
        $response = $this->get('reportes/pacientes-por-odontologo');

        //act


        //assert
        $response->assertStatus(302);
    }

    public function test_get_monto_presupuesto_por_meses(): void
    {
        //arrange
        $response = $this->get('reportes/total-presupuesto-por-meses');

        //act
        
        //assert
        $response->assertStatus(302);
    }

}
