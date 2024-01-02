<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tratamiento;
use Illuminate\Http\Request;

use App\Models\OdontogramaDetalle;
use App\Models\Odontograma;
use App\Models\Paciente;
use Barryvdh\DomPDF\Facade\Pdf;

class PacientesPorTratamientoController extends Controller
{
    public function get_pacientes_por_tratamiento(Request $request)
    {
        $tratamientos = Tratamiento::all()->sortBy('nombre');

        $odontogramaDetalleIds = OdontogramaDetalle::where('tratamiento_id', $request->tratamiento_id)
            ->pluck('odontograma_cabecera_id');

        $odontogramaCabeceraPacienteIds = Odontograma::whereIn('id', $odontogramaDetalleIds)
            ->pluck('paciente_id');

        $pacientes = Paciente::whereIn('id', $odontogramaCabeceraPacienteIds)
            ->get();

        if ($request->ajax()) {
            return response()->json(['pacientes' => $pacientes]);
        }
        return view('reportes.pacientes-por-tratamiento.index', compact(['pacientes', 'tratamientos']));
    }

    public function generate_pdf(Request $request)
    {

        if($request->tratamiento_id == "0"){
            return back()->with('danger', 'Debe seleccionar un tratamiento');
        }

        $tratamiento = Tratamiento::findOrFail($request->tratamiento_id);

        $odontogramaDetalleIds = OdontogramaDetalle::where('tratamiento_id', $request->tratamiento_id)
            ->pluck('odontograma_cabecera_id');

        $odontogramaCabeceraPacienteIds = Odontograma::whereIn('id', $odontogramaDetalleIds)
            ->pluck('paciente_id');

        $pacientes = Paciente::whereIn('id', $odontogramaCabeceraPacienteIds)
            ->get();
            
        $pdf = Pdf::loadView('reportes.pacientes-por-tratamiento.pdf', compact(['pacientes', 'tratamiento']));
        return $pdf->stream();
    }
}
