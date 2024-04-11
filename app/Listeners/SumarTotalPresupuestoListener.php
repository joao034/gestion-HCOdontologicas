<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SumarTotalPresupuestoListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event->accion === 'add') {
            $odontograma = $event->detalle_odontograma->odontograma_cabecera;
            $odontograma->total += $event->detalle_odontograma->precio;
            $odontograma->save();
        }
    }
}
