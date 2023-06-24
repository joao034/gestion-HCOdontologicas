<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Odontograma;
use App\Models\Odontologo;
use Illuminate\Http\Request;
use App\Models\Tratamiento;
use App\Models\OdontogramaDetalle;
use App\Models\Paciente;
use App\Models\Simbolo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OdontogramaController extends Controller
{
    public function index( Request $request)
    {
        $search = trim( $request->get('search') );
        //devulve todos los odontogramas del paciente a buscar
        $odontogramas = Odontograma::join('pacientes', 'odontograma_cabecera.paciente_id', '=', 'pacientes.id')
            ->select('odontograma_cabecera.*', 'pacientes.cedula as paciente_cedula', 'pacientes.nombres as paciente_nombres', 'pacientes.apellidos as paciente_apellidos') 
            ->where('pacientes.nombres', 'LIKE', '%'.$search.'%')
            ->orWhere('pacientes.apellidos', 'LIKE', '%'.$search.'%')
            ->orWhere('pacientes.cedula', 'LIKE', '%'.$search.'%')
            ->get();
        
        return view('odontogramas.index', compact(['search', 'odontogramas']));
    }

    public function search ( Request $request ){
        $searchInput = $request->input('searInput'); // Obtener el término de búsqueda del request

        $resultados = Paciente::where('cedula', 'LIKE', "%{$searchInput}%")
                                ->orWhere('nombres', 'LIKE', "%{$searchInput}%")
                                ->orWhere('apellidos', 'LIKE', "%{$searchInput}%")
                                ->get();
                                
        return response()->json($resultados);
    }

    //guarda el detalle del odontograma
    public function store( Request $request ){
        
        try{
            $detalle_odontograma = new OdontogramaDetalle();

            //dd($request->all());

            $detalle_odontograma->fecha = Carbon::now();
            $detalle_odontograma->num_pieza_dental = $request->num_pieza_dental;
            $detalle_odontograma->cara_dental = $request->cara_dental;
            $detalle_odontograma->simbolo_id = $request->simbolo_id;
            $detalle_odontograma->odontograma_cabecera_id = $request->odontograma_cabecera_id;
            $detalle_odontograma->tratamiento_id = $request->tratamiento_id;
            $detalle_odontograma->odontologo_id = $request->odontologo_id;
            $detalle_odontograma->observacion = $request->observacion;
            //consultar el color del simbolo
            $simbolo = Simbolo::find($request->simbolo_id);
            if($simbolo->color == '#dc3545'){ //si es rojo
                $detalle_odontograma->estado = 'necesario';
            }else if($simbolo->color == '#3243a6'){ //si es azul
                $detalle_odontograma->estado = 'realizado';
            }
            $detalle_odontograma->save();
    
        }catch(\Exception $e){
            return $e->getMessage();
        }
        
        return $this->redireccionarOdontograma($request->odontograma_cabecera_id)
                    ->with('message', 'Detalle agreagado correctamente');

    }

    public function edit ( int $id ){

        $odontograma = Odontograma::find($id);
        $tratamientos = Tratamiento::all();
        $odontologos = Odontologo::all();
        $simbolo = new Simbolo();
        $rojo = '#dc3545';
        $azul = '#3243a6';
        $simbolosRojos = $simbolo->getSimbolosPorColor( $rojo );
        $simbolosAzules = $simbolo->getSimbolosPorColor( $azul );

        return view('odontogramas.edit', compact(['tratamientos', 'odontograma', 'odontologos', 'simbolosRojos', 'simbolosAzules']));
    }

    private function redireccionarOdontograma( int $id ){
        
        $odontograma = Odontograma::find($id);
        $tratamientos = Tratamiento::all();
        $odontologos = Odontologo::all();
        return redirect()->route('odontogramas.edit', compact(['tratamientos', 'odontologos', 'odontograma']));
    } 

}
