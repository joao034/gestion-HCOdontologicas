<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Odontograma;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\OdontogramaDetalle;
use Carbon\Carbon;

class OdontogramaController extends Controller
{

    public function __construct()
    {
    }

    public function index( Request $request)
    {
        $search = trim( $request->get('search') );
        $pacientes = Paciente::getAllPacientesWithPagination( $search, 'updated_at', 'desc' );
        return view('odontogramas.index', compact(['search', 'pacientes']));
    }

    public function nuevo ( int $paciente_id ){
        try{
            $odontograma = new Odontograma();
            $odontograma->fecha_creacion = Carbon::now();
            $odontograma->paciente_id = $paciente_id;
            $odontograma->total = 0;
            $odontograma->save();
            return to_route('detalleOdontogramas.edit', $odontograma->id)->with('message', 'Odontograma creado correctamente');
        }catch(\Exception $e){
            return back()->with('danger', 'No se pudo crear el nuevo odontograma. ');
        }
    }

    public function show( int $paciente_id ){
        $paciente = Paciente::find($paciente_id);

        
        // Ordenar los odontogramas por fecha en orden descendente
        $odontogramas = $paciente->odontogramasCabecera()->latest('updated_at')->get();

        //si el paciente tiene mas de un odontograma muestra la vista show
        if($odontogramas->count() > 1){
            return view('odontogramas.show', compact(['paciente', 'odontogramas']));     
        }
        
        //Si tiene solo un odontograma redirije directamente al unico odontograma disponible
        return to_route('detalleOdontogramas.edit', $odontogramas->first()->id);    
    }

    public function store( Request $request ){

    }

    public function edit ( int $id ){


    }

    public function destroy( int $id ){
        try{
            $odontograma = Odontograma::find($id);
            //solo elimina si tiene el paciente tiene mas de un odontograma
            if( $odontograma->getNumeroDeOdontogramasDeUnPaciente( $odontograma->paciente_id ) > 1 ){
                //elimina los detalles del odontograma
                OdontogramaDetalle::where('odontograma_cabecera_id', $id)->delete();
                $odontograma->delete();
                return to_route('odontogramas.index')->with('message', 'Odontograma eliminado correctamente');
            }
            return to_route('odontogramas.index')->with('danger', 'No se puede eliminar el odontograma del paciente, porque solo tiene un odontograma registrado');
            
        }catch(\Exception $e){
            return to_route('odontogramas.index')->with('danger', 'Error al eliminar el odontograma');
        } 
    }

}
