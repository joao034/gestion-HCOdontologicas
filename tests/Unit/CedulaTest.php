<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Validador;

class CedulaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_valid_cedula(): void
    {
        $validator = new Validador();

        // Prueba con cédulas válidas
        $this->assertTrue($validator->validarCedula('1851005361'));
        $this->assertTrue($validator->validarCedula('1715586242'));
        $this->assertTrue($validator->validarCedula('0402119689'));
        $this->assertTrue($validator->validarCedula('1324324324'));
        $this->assertTrue($validator->validarCedula('1231321322'));
    }

    public function test_invalid_cedula(): void
    {
        $validator = new Validador();

        // Prueba con cédulas inválidas
        $this->assertFalse($validator->validarCedula('1719142905'));
        $this->assertFalse($validator->validarCedula('1712345679'));
        $this->assertTrue($validator->validarCedula('0001321322'));
    }
}
