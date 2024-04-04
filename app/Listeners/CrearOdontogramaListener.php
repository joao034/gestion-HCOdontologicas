<?php

namespace App\Listeners;

use App\Events\NuevoPacienteEvent;
use App\Models\Odontograma;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CrearOdontogramaListener
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
    public function handle(NuevoPacienteEvent $event): void
    {
        Odontograma::create([
            'total' => 0,
            'paciente_id' => $event->paciente->id
        ]);
   
    }
}
