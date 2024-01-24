<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Odontograma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresupuestoPorTiempoController extends Controller
{
    //no se usa
    public function get_total_por_meses(Request $request)
    {
        $yearSelected = $request->year;

        $years = Odontograma::select(DB::raw('YEAR(created_at) as year'))
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

    public function get_total_presupuestos_y_abonos_por_meses(Request $request)
    {
        $yearSelected = $request->year;

        $years = Odontograma::select(DB::raw('YEAR(created_at) as year'))
            ->distinct()
            ->orderBy(DB::raw('year'), 'desc')->get();

        //obtiene el total de presupuestos por mes
        $subquery = DB::table('odontograma_cabecera as oc')
            ->select(
                DB::raw('YEAR(oc.created_at) as anio'),
                DB::raw('MONTHNAME(oc.created_at) as mes'),
                DB::raw('COALESCE(SUM(oc.total), 0) as total_presupuestos'),
                DB::raw('0 as total_abonos')
            )
            ->whereYear('oc.created_at', $yearSelected)
            ->groupBy('anio', 'mes');

        /* $subquery2 = DB::table('odontograma_cabecera as oc')
            ->select(
                DB::raw('YEAR(oc.created_at) as anio'),
                DB::raw('MONTHNAME(oc.created_at) as mes'),
                DB::raw('0 as total_presupuestos'),
                DB::raw('COALESCE(SUM(a.monto), 0) as total_abonos')
            )
            ->leftJoin('odontograma_detalle as od', 'oc.id', '=', 'od.odontograma_cabecera_id')
            ->leftJoin('abonos as a', 'od.id', '=', 'a.odontograma_detalle_id')
            ->whereYear('oc.created_at', $yearSelected)
            ->groupBy('anio', 'mes'); */
                
            //obtiene el total de abonos por mes
            $subquery2 = DB::table('abonos as a')   
            ->select(
                DB::raw('YEAR(a.created_at) as anio'),
                DB::raw('MONTHNAME(a.created_at) as mes'),
                DB::raw('0 as total_presupuestos'),
                DB::raw('COALESCE(SUM(a.monto), 0) as total_abonos')
            )->whereYear('a.created_at', $yearSelected)
            ->groupBy('anio', 'mes');

        $resultados = DB::table(DB::raw("({$subquery->toSql()} UNION ALL {$subquery2->toSql()}) as subquery"))
            ->mergeBindings($subquery)
            ->mergeBindings($subquery2)
            ->select('anio', 'mes', DB::raw('COALESCE(SUM(total_presupuestos), 0) as total_presupuestos'), DB::raw('COALESCE(SUM(total_abonos), 0) as total_abonos'))
            ->groupBy('anio', 'mes')
            ->get();

        if ($request->ajax())
            return response()->json(['resultados' => $resultados]);

        return view('reportes.total-presupuesto-por-meses.index', compact(['resultados', 'years']));
    }
}
