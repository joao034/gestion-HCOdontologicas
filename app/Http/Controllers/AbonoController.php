<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Abono;
use App\Models\OdontogramaDetalle;

class AbonoController extends Controller
{

    public function show(int $presupuesto_id){
        $detalles = OdontogramaDetalle::where('odontograma_cabecera_id', $presupuesto_id)->get();
        $abonos = Abono::whereIn('odontograma_detalle_id', $detalles->pluck('id'))->get();
        return view ('abonos.show', compact('abonos'));
    }

    public function store(Request $request)
    {
        try {
            $selectedIds = explode(',', $request->input('detalles_check_values'));

            foreach ($selectedIds as $detalle_id) {
                $abono = new Abono();
                $abono->odontograma_detalle_id = $detalle_id;
                $detalle_presupuesto = OdontogramaDetalle::find($detalle_id);
                $abono->monto = $detalle_presupuesto->precio - $detalle_presupuesto->get_total_abonos();
                $abono->save();
            }
            return back()->with('message', 'Abonos guardados correctamente');
        } catch (\Exception $e) {
            return back()->with('danger', 'Error al registrar el abono. Seleccione al menos un detalle');
        }
    }

    public function delete(int $id)
    {
        try {
            $abono = Abono::find($id);
            $abono->delete();
            return back()->with('message', 'Abono eliminado correctamente');
        } catch (\Exception $e) {
            return back()->with('danger', 'Error al eliminar el abono');
        }
    }
}
