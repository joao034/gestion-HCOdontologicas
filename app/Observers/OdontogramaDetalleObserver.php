<?php

namespace App\Observers;

use App\Models\OdontogramaDetalle;

class OdontogramaDetalleObserver
{
    /**
     * Handle the OdontogramaDetalle "created" event.
     */
    public function created(OdontogramaDetalle $odontogramaDetalle): void
    {
        $odontograma = $odontogramaDetalle->odontograma_cabecera;
        $odontograma->total += $odontogramaDetalle->precio;
        $odontograma->save();
    }

    /**
     * Handle the OdontogramaDetalle "updated" event.
     */
    public function updated(OdontogramaDetalle $odontogramaDetalle): void
    {
        //
    }

    /**
     * Handle the OdontogramaDetalle "deleted" event.
     */
    public function deleted(OdontogramaDetalle $odontogramaDetalle): void
    {
        $odontograma = $odontogramaDetalle->odontograma_cabecera;
        $odontograma->total -= $odontogramaDetalle->precio;
        $odontograma->save();
    }

    /**
     * Handle the OdontogramaDetalle "restored" event.
     */
    public function restored(OdontogramaDetalle $odontogramaDetalle): void
    {
        //
    }

    /**
     * Handle the OdontogramaDetalle "force deleted" event.
     */
    public function forceDeleted(OdontogramaDetalle $odontogramaDetalle): void
    {
        //
    }
}
