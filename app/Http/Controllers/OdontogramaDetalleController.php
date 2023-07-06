<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Odontograma;
use App\Models\Odontologo;
use Illuminate\Http\Request;
use App\Models\Tratamiento;
use App\Models\OdontogramaDetalle;
use App\Models\Simbolo;
use Carbon\Carbon;

class OdontogramaDetalleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index( int $odontograma_cabecera_id )
    {
       $detalles_odontograma = OdontogramaDetalle::query()
                             ->where('odontograma_cabecera_id', '=', "$odontograma_cabecera_id")
                             ->get();
        return view('odontogramas.index_detalle', compact(['detalles_odontograma']));
    }

    //guarda el detalle del odontograma
    public function store( Request $request ){
        
        try{
            $detalle_odontograma = new OdontogramaDetalle();

            $detalle_odontograma->fecha = Carbon::now();
            $detalle_odontograma->num_pieza_dental = $request->num_pieza_dental;
            $detalle_odontograma->cara_dental = $request->cara_dental;
            $detalle_odontograma->simbolo_id = $request->simbolo_id;
            $detalle_odontograma->odontograma_cabecera_id = $request->odontograma_cabecera_id;
            $detalle_odontograma->tratamiento_id = $request->tratamiento_id;
            $detalle_odontograma->odontologo_id = $request->odontologo_id;
            $detalle_odontograma->observacion = $request->observacion;

            //consultar el tipo del simbolo
            $simbolo = Simbolo::find($request->simbolo_id);
            if($simbolo->tipo == 'necesario'){ //si es rojo
                $detalle_odontograma->estado = 'necesario';
            }else if($simbolo->tipo == 'realizado'){ //si es azul
                 $detalle_odontograma->estado = 'realizado';
            }
            $detalle_odontograma->save();
            return back()->with('message', 'Detalle del odontograma agreagado correctamente.');

        }catch(\Exception $e){
            return back()->with('danger', 'No se pudo guardar el detalle del odontograma.');
        }

    }

    public function edit ( int $id ){

        $odontograma = Odontograma::find($id);
        $tratamientos = Tratamiento::orderBy('nombre', 'asc')->get();
        $odontologos = Odontologo::all();
        $simbolo = new Simbolo();
        $necesario = 'necesario';
        $realizado = 'realizado';
        $simbolosRojos = $simbolo->getSimbolosPorTipo( $necesario );
        $simbolosAzules = $simbolo->getSimbolosPorTipo( $realizado );

        $detalles_odontograma = OdontogramaDetalle::query()
                             ->where('odontograma_cabecera_id', '=', "$id")
                             ->where('estado', '=', 'necesario')
                             ->orWhere('estado', '=', 'realizado')
                             ->orWhere('estado', '=', 'fuera_presupuesto')
                             ->get();

        return view('odontogramas.edit', compact(['tratamientos', 'odontograma', 'detalles_odontograma',
                                        'odontologos', 'simbolosRojos', 'simbolosAzules']));
    }

    public function destroy( int $id ){
        try{
           $detalle_odontograma = OdontogramaDetalle::find($id);
           $detalle_odontograma->delete();
            return back()->with('message', 'Detalle del odontograma eliminado correctamente.'); 
        }catch(\Exception $e){
            return back()->with('danger', 'No se pudo eliminar el detalle del odontograma.'); 
        }
        
    }
}
