<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\OdontogramaDetalle;
use App\Models\Odontograma;
use App\Models\Odontologo;

class ReportController extends Controller
{

    

    public function get_total_por_rango_de_fechas(Request $request)
    {

        $sumaTotal = Odontograma::whereBetween('fecha_creacion', [$request->fecha_inicio, $request->fechaFin])
            ->sum('total');

        dd($sumaTotal);
    }
}
