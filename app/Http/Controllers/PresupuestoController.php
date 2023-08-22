<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Odontograma;
use App\Models\OdontogramaDetalle;
use App\Models\Odontologo;
use App\Models\Simbolo;
use App\Models\Tratamiento;
use App\Models\Paciente;
use Carbon\Carbon;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf;

class PresupuestoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index( Request $request )
    {
        $search = trim( $request->get('search') );
        //devulve todos los presupuestos del paciente a buscar
        $presupuestos = Odontograma::join('pacientes', 'odontograma_cabecera.paciente_id', '=', 'pacientes.id')
            ->select('odontograma_cabecera.*', 'pacientes.cedula as paciente_cedula', 'pacientes.nombres as paciente_nombres', 'pacientes.apellidos as paciente_apellidos') 
            ->where('pacientes.nombres', 'LIKE', '%'.$search.'%')
            ->orWhere('pacientes.apellidos', 'LIKE', '%'.$search.'%')
            ->orWhere('pacientes.cedula', 'LIKE', '%'.$search.'%')
            ->orderBy('apellidos', 'asc')
            ->paginate(10);
        
        return view('presupuestos.index', compact(['search', 'presupuestos']));
    }

    //Exporta a pdf el presupuesto
    public function pdf( $id ){

        $presupuesto = Odontograma::find( $id );
        $paciente = Paciente::find( $presupuesto->paciente_id );
        $detalles_presupuesto = $this->getDetallesPresupuesto( $id );

        $pdf = Pdf::loadView('presupuestos.pdf', compact('paciente', 'presupuesto', 'detalles_presupuesto'));
        return $pdf->stream();
        
    }

    //almacena los detalles del presupuesto
    public function store( Request $request ){

        try{
            $detalle_presupuesto = new OdontogramaDetalle();
            $detalle_presupuesto->odontograma_cabecera_id = $request->presupuesto_id;
            $detalle_presupuesto->tratamiento_id = $request->tratamiento_id;
            $detalle_presupuesto->fecha = Carbon::now();
            $detalle_presupuesto->num_pieza_dental = "-";
            $detalle_presupuesto->cara_dental = "-";
            $detalle_presupuesto->precio = Tratamiento::find( $request->tratamiento_id )->precio;
            $detalle_presupuesto->simbolo_id = Simbolo::first()->id;
            $detalle_presupuesto->odontologo_id = Odontologo::first()->id;
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
        $detalles_presupuesto = $this->getDetallesPresupuesto( $id );
        $tratamientos = Tratamiento::orderBy('nombre', 'asc')->get();

        return view('presupuestos.detalle_presupuesto', compact('detalles_presupuesto', 'presupuesto', 'tratamientos'));
    }

    public function update( Request $request, int $id ){}


    //actualiza el estado del detalle del presupuesto a fuera de presupuesto al momento de eliminarlo en la interfaz
    public function updateEstado ( int $id ){
        try{
            $detalle_presupuesto = OdontogramaDetalle::find( $id );
            $detalle_presupuesto->estado = 'fuera_presupuesto';

            //encontrar el presupuesto al que pertenece el detalle
            $presupuesto = Odontograma::find( $detalle_presupuesto->odontograma_cabecera_id );
            $presupuesto->total = $presupuesto->total - $detalle_presupuesto->precio;
            
            $presupuesto->save();
            $detalle_presupuesto->save();
            return back()->with('message', 'Tratamiento eliminado del presupuesto.');
        }catch(\Exception $e){
            return back()->with('danger', 'No se pudo eliminar el tratamiento del presupuesto.');
        }
    }

    private function getDetallesPresupuesto ( int $id ){
        $detalles_presupuesto = OdontogramaDetalle::query()
                                                ->where('odontograma_cabecera_id', '=', "$id")
                                                ->where( function( $query ) {
                                                    $query->where('estado', '=', 'necesario')
                                                    ->orWhere('estado', '=', 'presupuesto');
                                                })->get(); 
        return $detalles_presupuesto;
    }

    public function updatePrecio ( int $id_detalle_presupuesto, Request $request ){
        //validar que el precio sea mayor a cero
        $request->validate([
            'precio' => 'required|numeric|min:1'
        ]);
        
        try{
            $detalle_presupuesto = OdontogramaDetalle::find( $id_detalle_presupuesto );

            $dif_precio = $detalle_presupuesto->precio - $request->precio;

            $presupuesto = Odontograma::find( $detalle_presupuesto->odontograma_cabecera_id );

            if( $request->precio > $detalle_presupuesto->precio ){
                $presupuesto->total = $presupuesto->total + ($dif_precio * (-1));
                $presupuesto->save();
            }

            if( $request->precio < $detalle_presupuesto->precio ){
                $presupuesto->total = $presupuesto->total - $dif_precio;
                $presupuesto->save();
            }

            $detalle_presupuesto->precio = $request->precio;
            $detalle_presupuesto->save();
            return back()->with('message' , 'Precio actualizado correctamente');
        }catch(\Exception $e){
            return back()->with('error' , 'No se pudo actualizar el precio');
        }
    }

}
