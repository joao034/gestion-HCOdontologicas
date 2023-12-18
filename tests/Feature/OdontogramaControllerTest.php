<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OdontogramaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function get_odontogramas_list()
    {
        $response = $this->get('/odontogramas');

        $response->assertStatus(200);
    }

    //create una prueba para crear un nuevo odontograma de un paciente
    public function create_odontograma()
    {
        $response = $this->get('/odontogramas/create');

        $response->assertStatus(200);
    }
}
