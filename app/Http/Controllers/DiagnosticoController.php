<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiagnosticoRequest;
use App\Models\Paciente;
use App\Models\Diagnostico;
use App\Models\HistoriaClinica;
use Exception;
use App\Models\User;

class DiagnosticoController extends Controller
{
    public function show(int $hclinica_id){
        $hClinica = HistoriaClinica::find($hclinica_id);
        $odontologos = User::get_odontologos_activos();
        return view('diagnosticos.show', compact('hClinica', 'odontologos'));
    }

    public function edit(Paciente $paciente){
        return view('diagnosticos.edit', compact('paciente'));
    }

    public function store(DiagnosticoRequest $request){
        try{
            Diagnostico::create($request->all());
            return back()->with('message', 'Diagnóstico guardado correctamente');
        }catch(Exception $e){
            return redirect()->back()->with('danger', 'Error al guardar el diagnóstico. '. $e->getMessage());
        }
    }

    public function update(DiagnosticoRequest $request, Diagnostico $diagnostico){
        try{
            $diagnostico->update($request->all());
            return back()->with('message', 'Diagnóstico actualizado correctamente');
        }catch(Exception $e){
            return back()->with('danger', 'Error al actualizar el diagnóstico. '. $e->getMessage());
        }
    }

    public function destroy(int $id_diagnostico){
        try{
            $diagnostico = Diagnostico::find($id_diagnostico);
            $diagnostico->delete();
            return back()->with('message', 'Diagnóstico eliminado correctamente');
        }catch(Exception $e){
            return back()->with('danger', 'Error al eliminar el diagnóstico'. $e->getMessage());
        }
    }
}
