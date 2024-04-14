<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacienteRequest;
use App\Models\HistoriaClinica;
use App\Models\Paciente;
use App\Models\TipoDocumento;
use App\Models\TipoNacionalidad;
use Exception;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->get('buscador'));
        $pacientes = Paciente::getAllPacientesWithPaginationDB($search, 'apellidos', 'asc');
        return view('pacientes.index', compact(['pacientes', 'search']));
    }

    public function store(PacienteRequest $request)
    {
        try {
            Paciente::create($request->all());
            //TODO: dispatch an event which create a new hclinica
            return to_route('pacientes.index');
        } catch (Exception $e) {
            return to_route('pacientes.index', 'No se pudo guardar el nuevo paciente');
        }
    }

    public function update(PacienteRequest $request, int $paciente_id)
    {
        try{
            $paciente = Paciente::findOrFail($paciente_id);
            $paciente->update($request->all());
            return back()->with('message', 'Datos actualizados exitosamente');
        }catch(Exception $e){
            throw $e;
        }   
        
    }

    public function show()
    {
    }

    public function create()
    {
        $tipos_documento = TipoDocumento::orderBy('nombre', 'asc')->get();
        $tipos_nacionalidad = TipoNacionalidad::all();
        return view("pacientes.create", compact(['tipos_documento', 'tipos_nacionalidad']));
    }

    public function edit(int $hclinica_id)
    {
        $hClinica = HistoriaClinica::find($hclinica_id);
        $paciente = $hClinica->paciente;
        $tipos_documento = TipoDocumento::orderBy('nombre', 'asc')->get();
        $tipos_nacionalidad = TipoNacionalidad::all();
        return view('pacientes.edit', compact(['hClinica','paciente', 'tipos_documento', 'tipos_nacionalidad']));
    }
}
