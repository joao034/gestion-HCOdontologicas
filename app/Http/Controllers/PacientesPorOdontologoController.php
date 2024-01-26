<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Odontologo;
use App\Models\Odontograma;
use App\Models\OdontogramaDetalle;
use App\Models\Paciente;
use Barryvdh\DomPDF\Facade\Pdf;

class PacientesPorOdontologoController extends Controller
{
    public function get_pacientes_por_odontologo(Request $request)
    {
        $odontologos = Odontologo::all();

        $odontogramaDetalleIds = OdontogramaDetalle::where('odontologo_id', $request->odontologo_id)
            ->pluck('odontograma_cabecera_id');

        $odontogramaCabeceraPacienteIds = Odontograma::whereIn('id', $odontogramaDetalleIds)
            ->pluck('paciente_id');

        $pacientes = Paciente::whereIn('id', $odontogramaCabeceraPacienteIds)
            ->orderBy('apellidos', 'asc')
            ->get();

        if ($request->ajax()) {
            return response()->json(['pacientes' => $pacientes]);
        }
        return view('reportes.pacientes-por-odontologo.index', compact(['pacientes', 'odontologos']));
    }

    public function generate_pdf(Request $request)
    {

        if($request->odontologo_id_origen == "0"){
            return back()->with('danger', 'Debe seleccionar un odontólogo');
        }

        $odontologo = Odontologo::findOrFail($request->odontologo_id_origen);

        $odontogramaDetalleIds = OdontogramaDetalle::where('odontologo_id', $request->odontologo_id_origen)
            ->pluck('odontograma_cabecera_id');

        $odontogramaCabeceraPacienteIds = Odontograma::whereIn('id', $odontogramaDetalleIds)
            ->pluck('paciente_id');

        $pacientes = Paciente::whereIn('id', $odontogramaCabeceraPacienteIds)
            ->orderBy('apellidos', 'asc')
            ->get();
            
        $pdf = Pdf::loadView('reportes.pacientes-por-odontologo.pdf', compact(['pacientes', 'odontologo']));
        return $pdf->stream();
    }
}
