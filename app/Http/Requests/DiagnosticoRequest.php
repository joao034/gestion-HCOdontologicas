<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiagnosticoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hclinica_id' => 'required',
            'diagnostico' => 'required',
            'CIE' => 'required',
            'tipo' => 'required'
        ];
    }
}
