<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PresupuestoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function get_presupuestos_list()
    {
        $response = $this->get('/presupuestos');

        $response->assertStatus(200);
    }
}
