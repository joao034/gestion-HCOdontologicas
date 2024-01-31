<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Diagnostico;
use Exception;

class DiagnosticoController extends Controller
{

    private function validate_diagnostico(Request $request){
        $request->validate([
            'paciente_id' => 'required',
            'diagnostico' => 'required',
            'CIE' => 'required',
            'tipo' => 'required'
        ]);
    }

    public function show(int $id_paciente){
        $paciente = Paciente::find($id_paciente);
        return view('diagnosticos.show', compact('paciente'));
    }

    public function edit(int $id_paciente){
        $paciente = Paciente::find($id_paciente);
        return view('diagnosticos.edit', compact('paciente'));
    }

    public function store(Request $request){
        try{
            $this->validate_diagnostico($request);
            $diagnostico = new Diagnostico();
            $this->asignar_variables_diagnostico($diagnostico, $request);
            return to_route('diagnosticos.show', $request->paciente_id)->with('message', 'Diagnóstico guardado correctamente');
        }catch(Exception $e){
            return redirect()->back()->with('danger', 'Error al guardar el diagnóstico. '. $e->getMessage());
        }
    }

    public function update(Request $request, int $id_diagnostico){
        try{
            $this->validate_diagnostico($request);
            $diagnostico = Diagnostico::find($id_diagnostico);
            $this->asignar_variables_diagnostico($diagnostico, $request);
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

    private function asignar_variables_diagnostico(Diagnostico $diagnostico, Request $request){
        $diagnostico->paciente_id = $request->paciente_id;
        $diagnostico->diagnostico = $request->diagnostico;
        $diagnostico->CIE = $request->CIE;
        $diagnostico->tipo = $request->tipo;
        $diagnostico->save();
    }

}
