<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Odontograma;


class TopPacientesPorPresupuesto extends Controller
{
    // Declare the property $meses
    private $meses;

    //crear un variable de meses para mostrar en la vista
    public function __construct()
    {
        $this->meses = array(
            '1' => 'Enero',
            '2' => 'Febrero',
            '3' => 'Marzo',
            '4' => 'Abril',
            '5' => 'Mayo',
            '6' => 'Junio',
            '7' => 'Julio',
            '8' => 'Agosto',
            '9' => 'Setiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
        );
    }

    //obtiene los 3 pacientes con mayor presupuesto
    public function get_top_3_pacientes_por_total_presupuesto(Request $request)
    {
        try {
            $yearSelected = $request->year;
            $monthSelected = $request->month;

            $years = Odontograma::select(DB::raw('YEAR(created_at) as year'))
                ->distinct()
                ->orderBy(DB::raw('year'), 'desc')->get();

            $resultados = Odontograma::selectRaw('SUM(odontograma_cabecera.total) as total_ventas, odontograma_cabecera.paciente_id as Paciente, odontograma_cabecera.id as IdOdontograma, MONTH(odontograma_cabecera.created_at) as mes, YEAR(odontograma_cabecera.created_at) as anio, pacientes.nombres as nombre_paciente, pacientes.apellidos as apellido_paciente')
                ->join('pacientes', 'odontograma_cabecera.paciente_id', '=', 'pacientes.id')
                ->whereMonth('odontograma_cabecera.created_at', $monthSelected)
                ->whereYear('odontograma_cabecera.created_at', $yearSelected)
                ->groupBy('odontograma_cabecera.paciente_id', 'odontograma_cabecera.id', 'mes', 'anio', 'nombre_paciente', 'apellido_paciente')
                ->orderByDesc('total_ventas')
                ->limit(3)
                ->get();

            return view('reportes.top-presupuestos.index', compact(['resultados', 'years']));
        } catch (\Exception $e) {
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }
}
