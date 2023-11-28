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
            return to_route('odontogramas.index')->with('message', 'Odontograma creado correctamente');
        }catch(\Exception $e){
            return to_route('odontogramas.index')->with('message', 'Error al crear el odontograma', $e->getMessage());
        }
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
