<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Validador extends Model
{
    
    public function __construct( $request ){
        $this->validarDatos( $request );
    }

    public function validarDatos( $request ){
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public static function validarCedula( $cedula ) {
        // Eliminar caracteres no numéricos de la cédula
        $cedula = preg_replace('/[^0-9]/', '', $cedula);
    
        // Verificar si la cédula tiene 10 dígitos
        if (strlen($cedula) !== 10) {
            return false;
        }
    
        // Extraer el último dígito (dígito verificador)
        $digitoVerificador = (int) substr($cedula, -1);
    
        // Extraer los primeros 9 dígitos
        $primerosDigitos = substr($cedula, 0, 9);
    
        // Calcular el dígito verificador esperado utilizando el algoritmo de validación
        $suma = 0;
        for ($i = 0; $i < 9; $i++) {
            $digito = (int) $primerosDigitos[$i];
            if ($i % 2 === 0) {
                $digito *= 2;
                if ($digito > 9) {
                    $digito -= 9;
                }
            }
            $suma += $digito;
        }
        $digitoEsperado = ($suma % 10 === 0) ? 0 : 10 - ($suma % 10);
    
        // Comprobar si el dígito verificador coincide con el dígito esperado
        return $digitoVerificador === $digitoEsperado;
    }
    
}