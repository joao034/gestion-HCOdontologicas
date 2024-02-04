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
        $odontologoId = $request->odontologo_id;

        $odontogramaDetalleIds = OdontogramaDetalle::where('odontologo_id', $odontologoId)
            ->where('estado', '=', 'necesario')
            ->pluck('odontograma_cabecera_id');

        $odontogramaCabeceraPacienteIds = Odontograma::whereIn('id', $odontogramaDetalleIds)
            ->pluck('paciente_id');

        $pacientes = Paciente::whereIn('id', $odontogramaCabeceraPacienteIds)
            ->orderBy('apellidos', 'asc')
            ->paginate(8);

        return view('reportes.pacientes-por-odontologo.index', compact(['pacientes', 'odontologos', 'odontologoId']));
    }

    //Funciona con JS
    /* public function get_pacientes_por_odontologo(Request $request)
    {
        $odontologos = Odontologo::all();

        $odontogramaDetalleIds = OdontogramaDetalle::where('odontologo_id', $request->odontologo_id)
            ->where('estado', '=', 'necesario')
            ->pluck('odontograma_cabecera_id');

        $odontogramaCabeceraPacienteIds = Odontograma::whereIn('id', $odontogramaDetalleIds)
            ->pluck('paciente_id');

        $pacientes = Paciente::whereIn('id', $odontogramaCabeceraPacienteIds)
            ->orderBy('apellidos', 'asc')
            ->get();

        return view('reportes.pacientes-por-odontologo.index', compact(['pacientes', 'odontologos']));
    } */

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
