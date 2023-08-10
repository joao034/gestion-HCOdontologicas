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

use Illuminate\Support\Facades\Validator;

class OdontogramaDetalleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'tratamiento_id' => ['required'],
            'odontologo_id' => ['required'],
            'cara_dental' => ['required'],
            'simbolo_id' => ['required'],
            'observacion' => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function mostrarErroresDeValidacion( $request ){
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    } 

    public function index( int $odontograma_cabecera_id )
    {
       
    }

    //guarda el detalle del odontograma
    public function store( Request $request ){
        
        try{
            $this->mostrarErroresDeValidacion( $request );
            $this->validator($request->all())->validate();
            $this->guardarDetalle( $request );
            return back()->with('message', 'Detalle del odontograma agreagado correctamente.');

        }catch(\Exception $e){
            return back()->with('danger', 'No se pudo guardar el detalle del odontograma.');
        }

    }

    //construye la vista modal del detalle del odontograma
    public function edit ( int $id ){

        $odontograma = Odontograma::find($id);
        $tratamientos = Tratamiento::orderBy('nombre', 'asc')->get();
        $odontologos = Odontologo::all();
        $simbolo = new Simbolo();
        $necesario = 'necesario';
        $realizado = 'realizado';
        $simbolosRojos = $simbolo->getSimbolosPorTipo( $necesario );
        $simbolosAzules = $simbolo->getSimbolosPorTipo( $realizado );

        $colorRojo = '#dc3545';
        $colorAzul = '#3243a6';

        $simboloRojo = $simbolosRojos->where('color', $colorRojo)->first();
        $simboloAzul = $simbolosAzules->where('color', $colorAzul)->first();

        $detalles_odontograma = $this->getDetallesOdontograma( $id );

        return view('odontogramas.edit', compact(['tratamientos', 'odontograma', 'detalles_odontograma',
                            'odontologos', 'simbolosRojos', 'simbolosAzules', 'simboloRojo', 'simboloAzul']));
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

    private function guardarDetalle( $request ){
        $detalle_odontograma = new OdontogramaDetalle();

        $detalle_odontograma->fecha = Carbon::now();
        $detalle_odontograma->num_pieza_dental = $request->num_pieza_dental;
        $detalle_odontograma->cara_dental = $this->eliminarElementosRepetidos($request->cara_dental);
        if(isset( $detalle_odontograma->cara_dental )){
            $detalle_odontograma->cara_dental = implode(",", $detalle_odontograma->cara_dental);
        }
        $detalle_odontograma->simbolo_id = $request->simbolo_id;
        $detalle_odontograma->odontograma_cabecera_id = $request->odontograma_cabecera_id;
        $detalle_odontograma->tratamiento_id = $request->tratamiento_id;
        $detalle_odontograma->precio = Tratamiento::find($request->tratamiento_id)->precio;
        $detalle_odontograma->odontologo_id = $request->odontologo_id;
        $detalle_odontograma->observacion = $request->observacion;

        //consultar el tipo del simbolo
        $simbolo = Simbolo::find($request->simbolo_id);
        //almacena el tipo del simbolo dependiendo si es realizado o necesario
        $detalle_odontograma->estado = $simbolo->tipo;
        $detalle_odontograma->save();
    }

    private function getDetallesOdontograma( int $odontograma_cabecera_id ){
        $detalles_odontograma = OdontogramaDetalle::query()
        ->where('odontograma_cabecera_id', '=', "$odontograma_cabecera_id")
        ->where( function( $query ){
           $query->where('estado', '=', 'necesario') 
                 ->orWhere('estado', '=', 'realizado')
                 ->orWhere('estado', '=', 'fuera_presupuesto');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return $detalles_odontograma;
    }

    private function eliminarElementosRepetidos( $array ){
        return array_unique($array);
    }
}
