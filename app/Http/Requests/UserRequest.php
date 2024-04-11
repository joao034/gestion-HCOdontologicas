<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //foreign keys
            'tipo_documento_id' => ['required', 'integer'],
            'tipo_nacionalidad_id' => ['required', 'integer'],
            //datos del paciente
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'cedula' => ['nullable', 'string', 'min:6', 'max:16'], //cedula hace referencia al nro del documento
            'estado_civil' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'ocupacion' => ['required', 'string', 'max:255'],
            'sexo' => ['required', 'string', 'max:255'],
            'celular' => ['nullable', 'min:10', 'max:10'],
            'telef_convencional' => ['nullable', 'min:6', 'max:9'],
            'fecha_nacimiento' => ['required', 'date', 'before:today', 'after:1900-01-01'],
        ];

    }
}
