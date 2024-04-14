<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacienteRequest;
use App\Models\Paciente;
use App\Models\TipoDocumento;
use App\Models\TipoNacionalidad;
use Exception;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function store(PacienteRequest $request){
        try{
            Paciente::create($request->all());
            //TODO: dispatch an event which create a new hclinica
            return to_route('pacientes.index');
        }catch(Exception $e){
            return to_route('pacientes.index', 'No se pudo guardar el nuevo paciente');
        }
        
    }

    public function update(PacienteRequest $request, Paciente $paciente){
        $paciente->update($request->all());
        return to_route('hclinicas.index');
    }

    public function index( Request $request ){
        $search = trim($request->get('buscador'));
        $pacientes = Paciente::getAllPacientesWithPaginationDB($search, 'apellidos', 'asc');
        return view('pacientes.index', compact(['pacientes', 'search']));
    }

    public function show(){

    }

    public function create(){
        $tipos_documento = TipoDocumento::orderBy('nombre', 'asc')->get();
        $tipos_nacionalidad = TipoNacionalidad::all();
        return view("pacientes.create", compact(['tipos_documento', 'tipos_nacionalidad']));
    }

    public function edit(Paciente $paciente){

    }
}
