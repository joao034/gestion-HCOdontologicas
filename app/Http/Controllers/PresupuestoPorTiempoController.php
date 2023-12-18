<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Odontograma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresupuestoPorTiempoController extends Controller
{
    public function get_total_por_meses(Request $request)
    {
        $yearSelected = $request->year;

        $years = Odontograma::select(
            DB::raw('YEAR(created_at) as year')
        )
            ->distinct()
            ->orderBy(DB::raw('year'), 'desc')->get();

        $resultados = Odontograma::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTHNAME(created_at) as month'),
            DB::raw('SUM(total) as total_por_mes')
        )
            ->whereYear('created_at', $yearSelected)
            ->groupBy(DB::raw('YEAR(created_at), MONTHNAME(created_at)'))
            ->get();

        if ($request->ajax()) 
            return response()->json(['resultados' => $resultados]);

        return view('reportes.total-presupuesto-por-meses.index', compact(['resultados', 'years']));
    }
}
