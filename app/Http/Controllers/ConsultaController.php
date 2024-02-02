<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\AntecedentePatologico;
use App\Models\Consulta;
use Exception;

class ConsultaController extends Controller
{
    public function edit($paciente_id)
    {
        $paciente = Paciente::find($paciente_id);
        return view('consultas.edit', compact('paciente'));
    }

    public function update(Request $request, int $paciente_id)
    {
        try {
            $paciente = Paciente::find($paciente_id);
            $this->guardarActualizarConsulta($request, $paciente);
            $this->guardarActualizarAntecedentePatologico($request, $paciente);
            return back()->with('message', 'Consulta actualizada correctamente');
        } catch (Exception $e) {
            return back()->with('danger', 'Error al actualizar la consulta');
        }
    }

    private function validate_consulta_data()
    {
        return [
            'motivo_consulta' => 'required|string|max:255',
            'enfermedad_actual' => 'required|string|max:255',
            //'partes_sistema' => 'string|max:255',
            'observaciones_examen' => 'required|string|max:255',
            /* 'presion_arterial' => 'numeric|',
            'frecuencia_cardiaca' => 'numeric|',
            'frecuencia_respiratoria' => 'numeric|',
            'temperatura' => 'numeric|between:35,42', */
        ];
    }

    private function validate_ant_patologicos_data()
    {
        return [
            'desc_personales' => 'required|string|max:255',
            'desc_familiares' => 'required|string|max:255',
        ];
    }

    private function guardarActualizarConsulta(Request $request, Paciente $paciente)
    {
        $this->validate($request, $this->validate_consulta_data());
        $paciente->consulta == null ? $paciente->consulta = new Consulta() : $paciente->consulta;
        $paciente->consulta->paciente_id = $paciente->id;
        $paciente->consulta->motivo_consulta = $request->input('motivo_consulta');
        $paciente->consulta->enfermedad_actual = $request->input('enfermedad_actual');
        $paciente->consulta->presion_arterial = $request->input('presion_arterial');
        $paciente->consulta->frecuencia_cardiaca = $request->input('frecuencia_cardiaca');
        $paciente->consulta->frecuencia_respiratoria = $request->input('frecuencia_respiratoria');
        $paciente->consulta->temperatura = $request->input('temperatura');
        if ($request->input('partes_sistema') != null || $request->input('partes_sistema') != "") {
            $paciente->consulta->partes_examen_estomatognatico = implode(",", $request->input('partes_sistema'));
        }
        $paciente->consulta->observaciones_examen = $request->input('observaciones_examen');
        $paciente->consulta->save();
    }

    private function guardarActualizarAntecedentePatologico(Request $request, Paciente $paciente)
    {
        $this->validate($request, $this->validate_ant_patologicos_data());
        $paciente->antecedentes_patologicos == null ? $paciente->antecedentes_patologicos = new AntecedentePatologico() : $paciente->antecedentes_patologicos;
        $paciente->antecedentes_patologicos->paciente_id = $paciente->id;
        if ($request->ant_personales != null || $request->ant_personales != "") {
            $paciente->antecedentes_patologicos->ant_personales = implode(",", $request->ant_personales);
        }
        $paciente->antecedentes_patologicos->desc_personales = $request->desc_personales;
        if ($request->ant_familiares != null || $request->ant_familiares != "") {
            $paciente->antecedentes_patologicos->ant_familiares = implode(",", $request->ant_familiares);
        }
        $paciente->antecedentes_patologicos->desc_familiares = $request->desc_familiares;
        $paciente->antecedentes_patologicos->save();
    }
}
