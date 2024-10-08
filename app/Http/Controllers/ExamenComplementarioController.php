<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamenComplementario;
use Exception;
use App\Models\Paciente;

class ExamenComplementarioController extends Controller
{
    public function show(int $id_paciente)
    {
        $paciente = Paciente::find($id_paciente);
        return view('examenesComplementarios.show', ['paciente' => $paciente]);
    }

    public function edit(int $id_paciente)
    {
        $paciente = Paciente::find($id_paciente);
        return view('examenesComplementarios.edit', ['paciente' => $paciente]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'paciente_id' => 'required|numeric',
                'examenes_solicitados' => 'required',
                'observaciones' => 'required',
            ]);
            $paciente = Paciente::find($request->paciente_id);
            $this->guardar_actualizar_examenes_complementarios($request, $paciente);
            return to_route('examenesComplementarios.show', $request->paciente_id,)->with('message', 'Examenenes Complementarios almacenados correctamente');;
        } catch (Exception $e) {
            return back()->with('danger', 'Error al almacenar los examenes complementarios'. $e->getMessage());
        }
    }

    private function guardar_actualizar_examenes_complementarios(Request $request, Paciente $paciente)
    {
        $paciente->examenesComplementarios == null ? $paciente->examenesComplementarios = new ExamenComplementario() : $paciente->examenesComplementarios;
        $paciente->examenesComplementarios->paciente_id = $paciente->id;
        $paciente->examenesComplementarios->examenes_solicitados = $request->examenes_solicitados;
        if ($request->tipos_examen != null || $request->tipos_examen != "") {
            $paciente->examenesComplementarios->tipos_examen = implode(",", $request->tipos_examen);
        }
        $paciente->examenesComplementarios->observaciones = $request->observaciones;
        $paciente->examenesComplementarios->save();
    }
}
