<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;

use App\Models\OdontogramaDetalle;
use App\Models\Odontograma;

class ReportController extends Controller
{

    public function index( Request $request ){

        $odontogramaDetalleIds = OdontogramaDetalle::where('odontologo_id', $request->id)
        ->pluck('odontograma_cabecera_id');

        $odontogramaCabeceraPacienteIds = Odontograma::whereIn('id', $odontogramaDetalleIds)
            ->pluck('paciente_id');

        $pacientes = Paciente::whereIn('id', $odontogramaCabeceraPacienteIds)
            ->get();

        return view('reportes.indexPacientesPorOdontologo', compact('pacientes'));
    }

    public function get_total_por_rango_de_fechas(  Request $request ){
        
        $sumaTotal = Odontograma::whereBetween('fecha_creacion', [$request->fecha_inicio, $request->fechaFin])
            ->sum('total');
        
        dd($sumaTotal);
    }
}
