<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //foreign keys
            'tipo_documento_id' => ['required', 'integer'],
            'tipo_nacionalidad_id' => ['required', 'integer'],
            //datos del paciente
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'num_identificacion' => ['nullable', 'string', 'min:6', 'max:16'],
            'estado_civil' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'ocupacion' => ['required', 'string', 'max:255'],
            'genero' => ['required', 'string', 'max:255'],
            'celular' => ['nullable', 'min:10', 'max:10'],
            'telef_convencional' => ['nullable', 'min:6', 'max:9'],
            'fecha_nacimiento' => ['required', 'date', 'before:today', 'after:1900-01-01'],
        ];
    }
}
