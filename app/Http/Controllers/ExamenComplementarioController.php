<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamenComplementarioRequest;
use Illuminate\Http\Request;
use App\Models\ExamenComplementario;
use App\Models\HistoriaClinica;
use Exception;

class ExamenComplementarioController extends Controller
{
    public function show(int $hclinica_id)
    {
        $hClinica = HistoriaClinica::find($hclinica_id);
        return view('examenesComplementarios.show', ['hClinica' => $hClinica]);
    }

    public function edit(int $hclinica_id)
    {
        $hClinica = HistoriaClinica::find($hclinica_id);
        return view('examenesComplementarios.edit', compact('hClinica'));
    }

    public function store(ExamenComplementarioRequest $request)
    {
        try {
            $hClinica = HistoriaClinica::find($request->hclinica_id);
            $this->guardar_actualizar_examenes_complementarios($request, $hClinica);
            return back()->with('message', 'Examenenes Complementarios almacenados correctamente');;
        } catch (Exception $e) {
            return back()->with('danger', 'Error al almacenar los examenes complementarios'. $e->getMessage());
        }
    }

    private function guardar_actualizar_examenes_complementarios(Request $request, HistoriaClinica $hClinica)
    {
        $hClinica->examenComplementario == null ? $hClinica->examenComplementario = new ExamenComplementario() : $hClinica->examenComplementario;
        $hClinica->examenComplementario->hclinica_id = $hClinica->id;
        $hClinica->examenComplementario->examenes_solicitados = $request->examenes_solicitados;
        if ($request->tipos_examen != null || $request->tipos_examen != "") {
            $hClinica->examenComplementario->tipos_examen = implode(",", $request->tipos_examen);
        }
        $hClinica->examenComplementario->observaciones = $request->observaciones;
        $hClinica->examenComplementario->save();
    }
}
