<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOdontogramaDetalleRequest extends FormRequest
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
            'tratamiento_id' => ['required'],
            'cara_dental' => ['required'],
            'simbolo_id' => ['required'],
            'odontologo_id' => ['required'],
            'observacion' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'tratamiento_id.required' => 'Seleccione un tratamiento.',
            'odontologo_id.required' => 'Seleccione un odontólogo.',
            'cara_dental.required' => 'Seleccione una cara dental.',
            'simbolo_id.required' => 'Seleccione un símbolo.',
            'observacion.max' => 'La prescripción no puede tener más de :max caracteres.',
        ];
    }
}
