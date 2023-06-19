<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Odontograma;
use Illuminate\Http\Request;
use App\Models\Tratamiento;
use Illuminate\Support\Facades\DB;

class OdontogramaController extends Controller
{
    //
    public function index( Request $request)
    {
        $search = trim( $request->get('search') );
        //busca los pacientes que coincidan con el criterio de busqueda usando eloquent
    
        $odontogramas = Odontograma::join('pacientes', 'odontograma_cabecera.paciente_id', '=', 'pacientes.id')
            ->select('odontograma_cabecera.*', 'pacientes.cedula as paciente_cedula', 'pacientes.nombres as paciente_nombres', 'pacientes.apellidos as paciente_apellidos') 
            ->where('pacientes.nombres', 'LIKE', '%'.$search.'%')
            ->orWhere('pacientes.apellidos', 'LIKE', '%'.$search.'%')
            ->orWhere('pacientes.cedula', 'LIKE', '%'.$search.'%')
            ->get();
        
        return view('odontogramas.index', compact(['search', 'odontogramas']));
    }

    
    public function odontograma(){
        $tratamientos = Tratamiento::all();
        return view('odontogramas.odontograma', compact('tratamientos'));
    }

    public function edit ( int $id ){

        $odontograma = Odontograma::find($id);
        $tratamientos = Tratamiento::all();

        return view('odontogramas.edit', compact(['tratamientos', 'odontograma']));
    }


}
