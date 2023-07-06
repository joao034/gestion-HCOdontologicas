<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Odontograma;
use App\Models\OdontogramaDetalle;
use App\Models\Tratamiento;
use Carbon\Carbon;
use Exception;

class PresupuestoController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index( Request $request )
    {
        $search = trim( $request->get('search') );
        //devulve todos los odontogramas del paciente a buscar
        $presupuestos = Odontograma::join('pacientes', 'odontograma_cabecera.paciente_id', '=', 'pacientes.id')
            ->select('odontograma_cabecera.*', 'pacientes.cedula as paciente_cedula', 'pacientes.nombres as paciente_nombres', 'pacientes.apellidos as paciente_apellidos') 
            ->where('pacientes.nombres', 'LIKE', '%'.$search.'%')
            ->orWhere('pacientes.apellidos', 'LIKE', '%'.$search.'%')
            ->orWhere('pacientes.cedula', 'LIKE', '%'.$search.'%')
            ->orderBy('apellidos', 'asc')
            ->get();
        
        return view('presupuestos.index', compact(['search', 'presupuestos']));
    }

    //almacena los detalles del presupuesto
    public function store( Request $request ){

        try{
            //utilizar la tabla presupuestos detalles o hacer ahi mismo en los detalles del odontograma
            $detalle_presupuesto = new OdontogramaDetalle();
            $detalle_presupuesto->odontograma_cabecera_id = $request->presupuesto_id;
            $detalle_presupuesto->tratamiento_id = $request->tratamiento_id;
            $detalle_presupuesto->fecha = Carbon::now();
            $detalle_presupuesto->num_pieza_dental = "-";
            $detalle_presupuesto->cara_dental = "-";
            $detalle_presupuesto->simbolo_id = 1;
            $detalle_presupuesto->odontologo_id = 34;
            $detalle_presupuesto->estado = 'presupuesto';
            $detalle_presupuesto->save();
            return back()->with('message', 'Tratamiento agregado al presupuesto.');
        }catch( Exception $e ){
            return back()->with('danger', 'No se agregó el tratamiento al presupuesto.');
        }

    }

    public function edit( int $id ){
        //Buscar el odontograma del paciente
        $presupuesto = Odontograma::find( $id );
        $detalles_presupuesto = OdontogramaDetalle::query()
                                                ->where('odontograma_cabecera_id', '=', "$id")
                                                ->where('estado', '=', 'necesario')
                                                ->orWhere('estado', '=', 'presupuesto')
                                                ->get();
        $tratamientos = Tratamiento::orderBy('nombre', 'asc')->get();

        return view('presupuestos.detalle_presupuesto', compact('detalles_presupuesto', 'presupuesto', 'tratamientos'));
    }

    public function update( Request $request, int $id ){
        try{
            $detalle_presupuesto = OdontogramaDetalle::find( $id );
            $detalle_presupuesto->estado = 'fuera_presupuesto';
            $detalle_presupuesto->save();
            return back()->with('message', 'Tratamiento eliminado del presupuesto.');
        }catch(\Exception $e){
            return back()->with('danger', 'No se pudo eliminar el tratamiento del presupuesto.');
        }
    }


    public function destroy ( int $id ){
        try{
            $detalle_presupuesto = OdontogramaDetalle::find( $id );
            $detalle_presupuesto->estado = 'fuera_presupuesto';
            $detalle_presupuesto->save();
            return back()->with('message', 'Tratamiento eliminado del presupuesto.');
        }catch(\Exception $e){
            return back()->with('danger', 'No se pudo eliminar el tratamiento del presupuesto.');
        }
    }

    

}
