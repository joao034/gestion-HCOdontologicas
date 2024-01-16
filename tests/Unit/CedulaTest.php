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
        $this->assertTrue($validator->validarCedula('0001321322'));

    }

    public function test_invalid_cedula(): void
    {
        $validator = new Validador();

        // Prueba con cédulas inválidas
        $this->assertFalse($validator->validarCedula('1719142905'));
        $this->assertFalse($validator->validarCedula('1712345679'));
        $this->assertFalse($validator->validarCedula('182'));
        $this->assertFalse($validator->validarCedula(''));
        //$this->assertFalse($validator->validarCedula('1324324324'));
        //$this->assertFalse($validator->validarCedula('1231321322'));
        $this->assertFalse($validator->validarCedula('1234567890'));
        $this->assertFalse($validator->validarCedula('0000000000'));
        $this->assertFalse($validator->validarCedula('1111111111'));
        $this->assertFalse($validator->validarCedula('2222222222'));
        $this->assertFalse($validator->validarCedula('3333333333'));
        $this->assertFalse($validator->validarCedula('5555555555'));
        $this->assertFalse($validator->validarCedula('4444444444'));
        $this->assertFalse($validator->validarCedula('6666666666'));
        $this->assertFalse($validator->validarCedula('7777777777'));
        $this->assertFalse($validator->validarCedula('8888888888'));
        $this->assertFalse($validator->validarCedula('9999999999'));
    }
}
