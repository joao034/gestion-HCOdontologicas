<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacienteRequest;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function store(PacienteRequest $request){
        Paciente::create($request->all());
        //TODO: dispatch an event which create a new hclinica
        return to_route('hclinicas.index');
    }

    public function update(PacienteRequest $request, Paciente $paciente){
        $paciente->update($request->all());
        return to_route('hclinicas.index');
    }
}
