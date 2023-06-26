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
    public function index( Request $request)
    {
       
    }

    public function nuevo ( int $id ){
        try{
            $odontograma1 = Odontograma::find( $id );
            $odontograma = new Odontograma();
            $odontograma->paciente_id = $odontograma1->id_paciente;
            $odontograma->save();
            return view('odontogramas.index')->with('message', 'Odontograma creado correctamente');
        }catch(\Exception $e){
            return view('odontogramas.index')->with('message', 'Error al crear el odontograma', $e->getMessage());
        }
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
            if($simbolo->tipo == 'necesario'){ //si es rojo
                $detalle_odontograma->estado = 'necesario';
            }else if($simbolo->color == 'realizado'){ //si es azul
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
        $necesario = 'necesario';
        $realizado = 'realizado';
        $simbolosRojos = $simbolo->getSimbolosPorTipo( $necesario );
        $simbolosAzules = $simbolo->getSimbolosPorTipo( $realizado );

        return view('odontogramas.edit', compact(['tratamientos', 'odontograma', 'odontologos', 'simbolosRojos', 'simbolosAzules']));
    }

    public function destroy( int $id ){
        try{
            
        }catch(\Exception $e){
           
        }
        
    }

    private function redireccionarOdontograma( int $id ){
        
        $odontograma = Odontograma::find($id);
        $tratamientos = Tratamiento::all();
        $odontologos = Odontologo::all();
        return redirect()->route('odontogramas.edit', compact(['tratamientos', 'odontologos', 'odontograma']));
    } 

}
