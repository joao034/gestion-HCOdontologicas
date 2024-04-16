<?php
namespace App\Services;

use App\Models\Abono;
use App\Models\OdontogramaDetalle;

class PresupuestoService{
    public function getTotalRealizado(int $presupuesto_id)
    {
        $detalles_presupuesto = OdontogramaDetalle::query()
        ->where('odontograma_cabecera_id', '=', "$presupuesto_id")
        ->where('estado', '=', 'realizado')->get();
        $sumantoria = 0;
        foreach ($detalles_presupuesto as $detalle_presupuesto) {
            $sumantoria += $detalle_presupuesto->precio;
        }
        return $sumantoria;
    }

    public function getTotalAbonado(int $presupuesto_id)
    {
        $detalles_presupuesto = $this->getDetallesPresupuesto($presupuesto_id);
        $sumatorio = 0;
        foreach ($detalles_presupuesto as $detalle_presupuesto) {
            $sumatorio += $this->getTotalDeAbonosDeDetalle($detalle_presupuesto->id);
        }
        return $sumatorio;
    }

    public function getDetallesPresupuesto(int $id)
    {
        $detalles_presupuesto = OdontogramaDetalle::query()
            ->where('odontograma_cabecera_id', '=', "$id")
            ->where('estado', '!=', 'hallazgo')
            ->orderByRaw("FIELD(estado , 'realizado', 'necesario')")
            ->get();

        $detalles_presupuesto->map(function ($detalle_presupuesto) {
            $detalle_presupuesto->abonos = $this->getTotalDeAbonosDeDetalle($detalle_presupuesto->id);
            return $detalle_presupuesto;
        });

        return $detalles_presupuesto;
    }

    private function getTotalDeAbonosDeDetalle(int $id_detalle)
    {
        $abonos = Abono::where('odontograma_detalle_id', '=', "$id_detalle")->get();
        $sumatorio = 0;
        foreach ($abonos as $abono) {
            $sumatorio += $abono->monto;
        }
        return $sumatorio;
    }
}