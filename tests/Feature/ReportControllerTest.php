<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Odontograma;

class ReportControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_pacientes_por_odontologo(): void
    {
        //arrange
        $response = $this->get('/reportes');

        //act


        //assert
        $response->assertStatus(200);
    }

}
